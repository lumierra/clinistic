<?php

namespace App\Http\Controllers\Admin\Radiologi;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\HasilRadiologi;
use App\Models\Kunjungan;
use App\Models\Produk;
use App\Models\Radiologi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class UbahRadiologiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cek = HasilRadiologi::where('radiologi_id', $id)->first();
        if ($cek){
            $data = $cek;
        } else {
            $radiologi = Radiologi::findOrFail($id);
            $hasil = HasilRadiologi::create([
                'radiologi_id' => $radiologi->id,
                'kd_radiologi' => $radiologi->kd_rad,
                'register' => $radiologi->register,
                'kunjungan_id' => $radiologi->id,
                'pasien_id' => $radiologi->pasien_id,
                'dokter_id' => $radiologi->dokter_id,
                'user_id' => Auth::user()->id,
            ]);
            $data = $hasil;
        }

        return view('admin.radiologi.table', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Kunjungan::where('tgl_masuk', $id)->whereIn('status_radiologi', ['belum', 'diproses', 'selesai'])->orderBy('status_radiologi', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kd_rad', function($row){
                    ($row->radiologi == '' ? $rad='' : $rad=$row->radiologi->kd_rad);
                    return '<a href="'.route('admin.radiologi.edit', $row->id).'" class="btn btn-sm btn-success" >'.$rad.'</a>';
                })
                ->addColumn('tgl_order', function($row){
                    ($row->rad == '' ? $tgl='' : $tgl=$row->radiologi->tgl_order);
                    return Carbon::parse($tgl)->format('d/m/Y');
                })
                ->editColumn('no_rm', function($row){
                    $gender = $row->pasien->gender->alias;
                    $tgl = $row->pasien->tgl_lahir;
                    $rm = '<span class="fw-bold">No. RM : </span>' .$row->no_rm;
                    $nama = '<span class="fw-bold">Nama : </span>'.$row->pasien->nama;
                    $ttl = '<span class="fw-bold">TTL : </span>'.$row->pasien->tempat_lahir.', '.Carbon::parse($row->pasien->tgl_lahir)->format('d/m/Y');
                    $jk = '<span class="fw-bold">JK/Umur : </span>' . $gender . ' / ' .Carbon::parse($tgl)->age .' Thn';
                    $result = $rm . '<br>' . $nama . '<br>' . $ttl .'<br>' . $jk;
                    return $result;
                })
                ->addColumn('nama', function($row){
                    return $row->pasien->nama ?? '';
                })
                ->addColumn('tgl_lahir', function($row){
                    return Carbon::parse($row->pasien->tgl_lahir)->format('d/m/Y');
                })
                ->editColumn('poliklinik_id', function($row){
                    return $row->poliklinik->nama ?? '';
                })
                ->addColumn('dokter_id', function($row){
                    return $row->dokter->nama ?? '';
                })
                ->editColumn('status', function($row){
                    if ($row->status_radiologi == 'belum'){
                        return '<span class="badge badge-danger">BELUM DIPROSES</span>';
                    } else if ($row->status_radiologi == 'diproses'){
                        return '<span class="badge badge-primary">SEDANG DIPROSES</span>';
                    } else if ($row->status_radiologi == 'selesai'){
                        return '<span class="badge badge-success">SELESAI DIPROSES</span>';
                    } else {
                        return '<span class="badge badge-danger">BATAL</span>';
                    }
                })
                ->addColumn('action', function($row){
                    if ($row->status_radiologi == 'selesai'){
                        $btn = '
                            <a href="'.env('APP_URL').'/layanan/hasil_radiologi/'.$row->radiologi->id.'" class="btn btn-dark btn-sm" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak Hasil">
                                <span class="fad fa-print fs-15"></span>
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </a>
                            <a href="'.route('admin.radiologi.edit', $row->id).'" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Input Hasil">
                                <span class="fad fa-arrow-from-left fs-15"></span>
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </a>
                            ';
                        return $btn;
                    } else {
                        $btn = '<a href="'.route('admin.radiologi.edit', $row->id).'" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Input Hasil">
                                <span class="fad fa-arrow-from-left fs-20 fa-fade"></span>
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </a>';
                        return $btn;
                    }
                })
                ->rawColumns(['action', 'kd_rad', 'status', 'no_rm'])
                ->make(true);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $radiologi = Radiologi::where('kunjungan_id', $id)->get();
        if ($request->status_rad == 'diproses'){
            $awal = $radiologi[0]->created_at;
            $akhir = Carbon::now();
            $diff  = date_diff($awal,$akhir);
            if ($diff->h > 0) {
                $lama = $diff->h . " jam " . $diff->i . " menit " . $diff->s . " detik";
            } else if ($diff->i > 0) {
                $lama = $diff->i . " menit " . $diff->s . " detik";
            } else {
                $lama = $diff->s . " detik";
            }

            foreach ($radiologi as $item){
                $data = Radiologi::findOrFail($item->id);
                $data->update([
                    'status' => $request->status_rad,
                    'respon_waktu' => $lama,
                ]);
            }
        } else if ($request->status_rad == 'selesai'){
            $kunjungan = Kunjungan::findOrFail($id);
            foreach ($radiologi as $item){
                $data = Radiologi::findOrFail($item->id);
                $data->update([
                    'status' => $request->status_rad,
                ]);
                $produk = Produk::findOrFail($item->produk_rad_id);
                $detailTransaksi = DetailTransaksi::where('kunjungan_id', $kunjungan->id)->orderBy('urut', 'desc')->first();
                $insertDetail = DetailTransaksi::create([
                    'no_transaksi' => $detailTransaksi->no_transaksi,
                    'no_rm' => $kunjungan->no_rm,
                    'register' => $kunjungan->register,
                    'tgl_masuk' => $kunjungan->tgl_masuk,
                    'transaksi_id' => $detailTransaksi->transaksi_id,
                    'kunjungan_id' => $kunjungan->id,
                    'dokter_id' => $kunjungan->dokter_id,
                    'pasien_id' => $kunjungan->pasien_id,
                    'poliklinik_id' => $kunjungan->poliklinik_id,
                    'user_id' => Auth::user()->id,
                    'produk_id' => $produk->id,
                    'jumlah' => 1,
                    'harga' => $produk->harga,
                    'urut' => $detailTransaksi->urut + 1,
                    'tgl_detail' => date('Y-m-d'),
                    'keterangan' => 'radiologi',
                ]);
            }
        }

        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->update([
            'status_radiologi' => $request->status_rad
        ]);

        return response()->json('Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
