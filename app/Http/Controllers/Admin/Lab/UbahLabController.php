<?php

namespace App\Http\Controllers\Admin\Lab;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\HasilLab;
use App\Models\Kunjungan;
use App\Models\Lab;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class UbahLabController extends Controller
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
    public function create(Request $request)
    {
        $hasilLab = HasilLab::where('kunjungan_id', $request->kunjungan)->get();
        $data = array();
        foreach ($hasilLab as $item) {
            $temp = [
                'no' => $item->lab_id,
                'nama' => $item->nama_produk,
            ];
            $data[] = $temp;
            // $data['no'] = $item->lab_id;
            // $data['nama'] = $item->lab->nama_produk;
            // if ($item->hasil == '' || $item->hasil == null){
            //     return response()->json([
            //         'status' => 'error',
            //         'message' => 'INPUT ' . $item->nama_produk . ' TIDAK BOLEH KOSONG'
            //     ]);
            // }
        }
        return response()->json($data);
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
        $cek = HasilLab::where('lab_id', $id)->first();
        if ($cek){
            $data = $cek;
        } else {
            $lab = Lab::findOrFail($id);
            $hasil = HasilLab::create([
                'lab_id' => $lab->id,
                'kd_lab' => $lab->kd_lab,
                'register' => $lab->register,
                'kunjungan_id' => $lab->id,
                'pasien_id' => $lab->pasien_id,
                'dokter_id' => $lab->dokter_id,
                'user_id' => Auth::user()->id,
            ]);
            $data = $hasil;
        }

        return view('admin.lab.table', compact('data'));
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
            $data = Kunjungan::where('tgl_order_lab', $id)->whereIn('status_lab', ['belum', 'diproses', 'selesai'])->orderBy('status_lab', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kd_lab', function($row){
                    ($row->lab != '' ? $lab=$row->lab->kd_lab : $lab='');
                    return '<a href="'.route('admin.lab.edit', $row->id).'" class="btn btn-sm btn-success" >'.$lab.'</a>';
                })
                ->addColumn('tgl_order', function($row){
                    ($row->lab != '' ? $tgl=$row->lab->tgl_order : $tgl='');
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
                    if ($row->status_lab == 'belum'){
                        return '<span class="badge badge-danger">BELUM DIPROSES</span>';
                    } else if ($row->status_lab == 'diproses'){
                        return '<span class="badge badge-warning">SEDANG DIPROSES</span>';
                    } else if ($row->status_lab == 'selesai'){
                        return '<span class="badge badge-success">SELESAI DIPROSES</span>';
                    } else {
                        return '<span class="badge badge-danger">BATAL</span>';
                    }
                })
                ->addColumn('action', function($row){
                    if ($row->status_lab == 'selesai'){
                        ($row->lab == '' ? $lab='' : $lab=$row->lab->kd_lab);
                        $btn = '
                            <a href="'.env('APP_URL').'/layanan/hasil_lab/'.$lab.'" class="btn btn-dark btn-sm" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak Hasil">
                                <span class="fad fa-print fs-15"></span>
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </a>
                            <a href="'.route('admin.lab.edit', $row->id).'" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Input Hasil">
                                <span class="fad fa-arrow-from-left fs-15 fa-fade"></span>
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </a>
                            ';
                        return $btn;
                    } else {
                        $btn = '<a href="'.route('admin.lab.edit', $row->id).'" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Input Hasil">
                                <span class="fad fa-arrow-from-left fs-20 fa-fade"></span>
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </a>';
                        return $btn;
                    }
                })
                ->rawColumns(['action', 'kd_lab', 'status', 'no_rm'])
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
        $lab = Lab::where('kunjungan_id', $id)->get();
        if ($request->status_lab == 'diproses'){
            $awal = $lab[0]->created_at;
            $akhir = Carbon::now();
            $diff  = date_diff($awal,$akhir);
            if ($diff->h > 0) {
                $lama = $diff->h . " jam " . $diff->i . " menit " . $diff->s . " detik";
            } else if ($diff->i > 0) {
                $lama = $diff->i . " menit " . $diff->s . " detik";
            } else {
                $lama = $diff->s . " detik";
            }
            foreach ($lab as $item){
                $data = Lab::findOrFail($item->id);
                $data->update([
                    'status' => $request->status_lab,
                    'respon_waktu' => $lama,
                ]);
            }
        } else if ($request->status_lab == 'selesai'){
            $kunjungan = Kunjungan::findOrFail($id);
            foreach ($lab as $item){
                $data = Lab::findOrFail($item->id);
                $data->update([
                    'status' => $request->status_lab,
                ]);
                $produk = Produk::findOrFail($item->produk_lab_id);
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
                    'keterangan' => 'lab',
                ]);
            }
        }

        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->update([
            'status_lab' => $request->status_lab
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
