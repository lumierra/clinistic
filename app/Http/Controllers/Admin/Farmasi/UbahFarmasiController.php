<?php

namespace App\Http\Controllers\Admin\Farmasi;

use App\Http\Controllers\Controller;
use App\Models\DetailFarmasiRacik;
use App\Models\DetailTransaksi;
use App\Models\Farmasi;
use App\Models\Kunjungan;
use App\Models\Obat;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class UbahFarmasiController extends Controller
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
        $kunjungan = Kunjungan::findOrFail($request->kunjungan);
        if ($kunjungan->status_farmasi == 'resep'){
            $kunjungan->update([
                'status_farmasi' => 'belum'
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'Success'
            ]);
        } else {
            return response()->json([
                'status' => 201,
                'message' => 'Order sudah diterima di pelayanan farmasi'
            ]);
        }
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
    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Kunjungan::where('status_farmasi', $id)->where('tgl_masuk', date('Y-m-d'))->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kd_farmasi', function($row){
                    return '<a href="'.route('admin.farmasi.edit', $row->id).'" class="btn btn-sm btn-success" >'.$row->farmasi->kd_farmasi ?? ''.'</a>';
                })
                ->addColumn('tgl_order', function($row){
                    return Carbon::parse($row->farmasi->tgl_order)->format('d/m/Y');
                })
                ->editColumn('no_rm', function($row){
                    $gender = $row->pasien->gender->alias;
                    return $row->pasien->no_rm . '<br>' . ' (' . $gender . ' / ' .Carbon::parse($row->pasien->tgl_lahir)->age .' Thn )';
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
                    if ($row->status_farmasi == 'belum'){
                        return '<span class="badge badge-sm badge-warning">BELUM DIPROSES</span>';
                    } else if ($row->status_farmasi == 'diproses'){
                        return '<span class="badge badge-sm badge-primary">DALAM PROSES</span>';
                    } else if ($row->status_farmasi == 'selesai'){
                        return '<span class="badge badge-sm badge-success">SELESAI</span>';
                    } else {
                        return '<span class="badge badge-sm badge-danger">BATAL</span>';
                    }
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('admin.farmasi.edit', $row->id).'" class="btn btn-info btn-sm">
                                <span class="fad fa-arrow-from-left fs-15"></span>
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </a>';
                    return $btn;
                })
                ->rawColumns(['action', 'kd_farmasi', 'status', 'no_rm'])
                ->make(true);
        }
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
            $data = Kunjungan::where('tgl_order_farmasi', $id)->whereIn('status_farmasi', ['belum', 'diproses', 'selesai'])->orderBy('status_farmasi', 'asc')->orderBy('register', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kd_farmasi', function($row){
                    if ($row->farmasi){
                        return '<a href="'.route('admin.farmasi.edit', $row->id).'" class="btn btn-sm btn-success" >'.$row->farmasi->kd_farmasi ?? ''.'</a>';
                    } else {
                        return '';
                    }
                })
                ->addColumn('tgl_order', function($row){
                    if ($row->farmasi){
                        return Carbon::parse($row->farmasi->tgl_order)->format('d/m/Y');
                    } else {
                        return '';
                    }
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
                    if ($row->status_farmasi == 'belum'){
                        return '<span class="badge badge-danger">BELUM DIPROSES</span>';
                    } else if ($row->status_farmasi == 'diproses'){
                        return '<span class="badge badge-primary">DALAM PROSES</span>';
                    } else if ($row->status_farmasi == 'selesai'){
                        return '<span class="badge badge-success">SELESAI</span>';
                    } else {
                        return '<span class="badge badge-danger">BATAL</span>';
                    }
                })
                ->addColumn('action', function($row){
                    // $btn = '<a href="'.route('admin.farmasi.edit', $row->id).'" class="btn btn-info btn-sm">
                    //             <span class="fad fa-arrow-from-left fs-20 fa-fade"></span>
                    //             <span class="path1"></span>
                    //             <span class="path2"></span>
                    //         </a>';
                    // return $btn;
                    if ($row->status_farmasi == 'selesai'){
                        ($row->farmasi == '' ? $farmasi='' : $farmasi=$row->farmasi->kd_farmasi);
                        $btn = '
                            <a href="'.env('APP_URL').'/layanan/hasil_farmasi/'.$farmasi.'" class="btn btn-dark btn-sm" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak Resep">
                                <span class="fad fa-print fs-15"></span>
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </a>
                            <a href="'.route('admin.farmasi.edit', $row->id).'" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Input">
                                <span class="fad fa-arrow-from-left fs-15 fa-fade"></span>
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </a>
                            ';
                        return $btn;
                    } else {
                        $btn = '<a href="'.route('admin.farmasi.edit', $row->id).'" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Input">
                                <span class="fad fa-arrow-from-left fs-20 fa-fade"></span>
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </a>';
                        return $btn;
                    }
                })
                ->rawColumns(['action', 'kd_farmasi', 'status', 'no_rm'])
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
        $farmasi = Farmasi::where('kunjungan_id', $id)->get();
        if ($request->status_farmasi == 'diproses'){
            $awal = $farmasi[0]->created_at;
            $akhir = Carbon::now();
            $diff  = date_diff($awal,$akhir);
            if ($diff->h > 0) {
                $lama = $diff->h . " jam " . $diff->i . " menit " . $diff->s . " detik";
            } else if ($diff->i > 0) {
                $lama = $diff->i . " menit " . $diff->s . " detik";
            } else {
                $lama = $diff->s . " detik";
            }

            foreach ($farmasi as $item){
                $data = Farmasi::findOrFail($item->id);
                $data->update([
                    'status' => $request->status_farmasi,
                    'respon_waktu' => $lama
                ]);
            }
        } else if ($request->status_farmasi == 'selesai'){
            $kunjungan = Kunjungan::findOrFail($id);
            foreach ($farmasi as $item){
                $data = Farmasi::findOrFail($item->id);

                if ($item->obat_pengganti_id == ''){
                    $obat = Obat::findOrFail($item->obat_id);
                } else {
                    $obat = Obat::findOrFail($item->obat_pengganti_id);
                }

                if ($item->status_racik == 'tidak' || $item->status_racik == '' || $item->status_racik == null){
                    $detailTransaksi = DetailTransaksi::where('kunjungan_id', $kunjungan->id)->orderBy('urut', 'desc')->first();
                    $cekObat = DetailTransaksi::where('kunjungan_id', $kunjungan->id)->where('produk_id', $obat->id)->where('keterangan', 'farmasi')->first();
                    if ($cekObat){
                        $cekObat->update([
                            'produk_id' => $obat->id,
                            'jumlah' => $item->jumlah,
                            'harga' => $obat->harga_jual,
                            'urut' => $detailTransaksi->urut + 1,
                            'tgl_detail' => date('Y-m-d'),
                            'keterangan' => 'farmasi',
                        ]);
                    } else {
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
                            'produk_id' => $obat->id,
                            'jumlah' => $item->jumlah,
                            'harga' => $obat->harga_jual,
                            'urut' => $detailTransaksi->urut + 1,
                            'tgl_detail' => date('Y-m-d'),
                            'keterangan' => 'farmasi',
                        ]);
                    }
                } else {
                    $detailRacik = DetailFarmasiRacik::where('farmasi_id', $item->id)->where('kunjungan_id', $kunjungan->id)->get();
                    foreach ($detailRacik as $racik){
                        $detailTransaksi = DetailTransaksi::where('kunjungan_id', $kunjungan->id)->orderBy('urut', 'desc')->first();
                        $namaObat = Obat::findOrFail($racik->obat_id);
                        $cekObat = DetailTransaksi::where('kunjungan_id', $kunjungan->id)->where('produk_id', $racik->obat_id)->where('keterangan', 'farmasi racik')->first();
                        if ($cekObat){
                            $cekObat->update([
                                'produk_id' => $namaObat->id,
                                'jumlah' => $racik->jumlah,
                                'harga' => $namaObat->harga_jual,
                                'urut' => $detailTransaksi->urut + 1,
                                'tgl_detail' => date('Y-m-d'),
                                'keterangan' => 'farmasi racik',
                            ]);
                        } else {
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
                                'produk_id' => $namaObat->id,
                                'jumlah' => $racik->jumlah,
                                'harga' => $namaObat->harga_jual,
                                'urut' => $detailTransaksi->urut + 1,
                                'tgl_detail' => date('Y-m-d'),
                                'keterangan' => 'farmasi racik',
                            ]);
                        }
                    }
                }

                $data->update([
                    'status' => $request->status_farmasi,
                ]);
            }
        }

        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->update([
            'status_farmasi' => $request->status_farmasi
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
