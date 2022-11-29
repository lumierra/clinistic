<?php

namespace App\Http\Controllers\Admin\Farmasi;

use App\Http\Controllers\Controller;
use App\Models\Farmasi;
use App\Models\Kunjungan;
use App\Models\Obat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class FarmasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kunjungan::where('tgl_order_farmasi', date('Y-m-d'))->whereIn('status_farmasi', ['belum', 'diproses', 'selesai'])->orderBy('status_farmasi', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kd_farmasi', function($row){
                    return '<a href="'.route('admin.farmasi.edit', $row->id).'" class="btn btn-sm btn-success" >'.$row->farmasi->kd_farmasi.'</a>';
                })
                ->addColumn('tgl_order', function($row){
                    return Carbon::parse($row->farmasi->tgl_order)->format('d/m/Y');
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
                        return '<span class="badge badge-warning">DALAM PROSES</span>';
                    } else if ($row->status_farmasi == 'selesai'){
                        return '<span class="badge badge-success">SELESAI</span>';
                    } else {
                        return '<span class="badge badge-danger">BATAL</span>';
                    }
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('admin.farmasi.edit', $row->id).'" class="btn btn-info btn-sm">
                                <span class="fad fa-arrow-from-left fs-20 fa-fade"></span>
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </a>';
                    return $btn;
                })
                ->rawColumns(['action', 'kd_farmasi', 'status', 'no_rm'])
                ->make(true);
        }

        $belum = $this->getData('belum');
        $diproses = $this->getData('diproses');
        $selesai = $this->getData('selesai');
        $batal = $this->getData('batal');

        return view('admin.farmasi.index', compact('belum', 'diproses', 'selesai', 'batal'));
    }

    protected function getData($status)
    {
        // $farmasi = Farmasi::where('status', $status)->distinct()->get('register')->count();
        $farmasi = Kunjungan::where('status_farmasi', $status)->where('tgl_masuk', date('Y-m-d'))->get()->count();
        return $farmasi;
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
        $kunjungan = Kunjungan::findOrFail($request->kunjungan);
        $cekFarmasi = Farmasi::where('kunjungan_id', $request->kunjungan)->whereIn('status', ['belum', 'diproses'])->first();
        if ($cekFarmasi){
            $newID = $cekFarmasi->kd_farmasi;
        } else {
            $lastID = Farmasi::select('kd_farmasi')->where('tgl_order', date('Y-m-d'))->orderBy('id', 'desc')->first();
            if (!$lastID){
                $newID = 'FAR-'.date('ymd').'-0001';
            }
            else{
                $lastIncrement = substr($lastID->kd_farmasi, -4, 4);
                $newID = 'FAR-'.date('ymd').'-'.str_pad($lastIncrement+1, 4, 0, STR_PAD_LEFT);
            }
        }

        $obat = Obat::findOrFail($request->obat_farmasi);
        if ($obat->stok < $request->jumlah){
            return response()->json('Stok obat tidak mencukupi', 500);
        } else {
            $farmasi = Farmasi::where('register', $kunjungan->register)->where('obat_id', $request->obat_farmasi)->where('status_racik', 'tidak')->first();

            if (!$farmasi){
                $obat->stok = $obat->stok - $request->jumlah;
                $obat->save();

                if ($kunjungan->status_farmasi == null){
                    $kunjungan->update([
                        'status_farmasi' => 'resep',
                        'tgl_order_farmasi' => date('Y-m-d'),
                    ]);
                }
                $status_farmasi = 'belum';

                $insert = Farmasi::updateOrCreate(
                    ['id' => $request->catatan]
                    ,[
                    'register' => $kunjungan->register,
                    'kunjungan_id' => $kunjungan->id,
                    'pasien_id' => $kunjungan->pasien_id,
                    'dokter_id' => $kunjungan->dokter_id,
                    'poliklinik_id' => $kunjungan->poliklinik_id,
                    'user_id' => Auth::user()->id,
                    'tgl_masuk' => $kunjungan->tgl_masuk,
                    'obat_id' => $request->obat_farmasi,
                    'kd_farmasi' => $newID,
                    'tgl_order' => date('Y-m-d'),
                    'status' => $status_farmasi,
                    'keterangan' => $request->keterangan,
                    'jumlah' => $request->jumlah,
                    'cara_penggunaan' => $request->cara,
                    'pagi' => $request->pagi,
                    'siang' => $request->siang,
                    'malam' => $request->malam,
                    'status_racik' => 'tidak',
                    'status_dokter' => 'belum',
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Success'
                ]);
            }
            return response()->json([
                'status' => false,
                'message' => 'Obat sudah diorder'
            ]);

        }
        return response()->json('Success');
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
            $data = Farmasi::where('kunjungan_id', $id)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('kd_farmasi', function($row){
                    return '<span class="btn btn-success btn-sm">'.$row->kd_farmasi .'</span>';
                })
                ->editColumn('obat_id', function($row){
                    if ($row->obat_pengganti_id == ''){
                        if ($row->status_racik == 'tidak' || $row->status_racik == '' || $row->status_racik == null){
                            $result = 'R/ ' . $row->obat->nama . ' ' . $row->obat->satuan->alias . '<br>' . 'S. ' . $row->keterangan;
                            $cara = $row->cara_penggunaan == 'sebelum_makan' ? 'Sebelum Makan,' : 'Sesudah Makan,';
                            $pagi = $row->pagi == 1 ? 'Pagi' : '';
                            $siang = $row->siang == 1 ? 'Siang' : '';
                            $malam = $row->malam == 1 ? 'Malam' : '';
                            // $result .= '<br>' . $cara . ' ' . $pagi . ' ' . $siang . ' ' . $malam;
                            return $result;
                        } else {
                            $detail = $row->detail_farmasi_racik;
                            $data = '';
                            foreach ($detail as $item){
                                $data .= $item->obat->nama . ' ' . $item->obat->satuan->alias . ' No.' . $item->jumlah . '<br>';
                            }
                            $result = 'R/ ' . $data . 'S. ' . $row->keterangan . '<br>' . '<span class="text-danger">(Racikan)</span>';
                            return $result;
                        }


                    } else {
                        $result = 'R/ ' . $row->obat->nama . ' ' . $row->obat->satuan->alias . '<br>' . 'S. ' . $row->keterangan;
                        $cara = $row->cara_penggunaan == 'sebelum_makan' ? 'Sebelum Makan,' : 'Sesudah Makan,';
                        $pagi = $row->pagi == 1 ? 'Pagi' : '';
                        $siang = $row->siang == 1 ? 'Siang' : '';
                        $malam = $row->malam == 1 ? 'Malam' : '';
                        // $result .= '<br>' . $cara . ' ' . $pagi . ' ' . $siang . ' ' . $malam;

                        $result1 = '<span class="text-danger fw-bolder">Diganti</span> <br>';
                        $result1 .= 'R/ ' . $row->obat_pengganti->nama . ' ' . $row->obat_pengganti->satuan->alias . '<br>' . 'S. ' . $row->keterangan_pengganti;
                        $cara1 = $row->cara_penggunaan_pengganti == 'sebelum_makan' ? 'Sebelum Makan,' : 'Sesudah Makan,';
                        $pagi1 = $row->pagi_pengganti == 1 ? 'Pagi' : '';
                        $siang1 = $row->siang_pengganti == 1 ? 'Siang' : '';
                        $malam1 = $row->malam_pengganti == 1 ? 'Malam' : '';
                        // $result1 .= '<br>' . $cara1 . ' ' . $pagi1 . ' ' . $siang1 . ' ' . $malam1;

                        return $result . '<br>' . $result1;
                    }
                })
                ->editColumn('jumlah', function($row){
                    if ($row->obat_pengganti_id == ''){
                        return $row->jumlah;
                    } else {
                        return $row->jumlah_pengganti;
                    }
                })
                ->editColumn('status', function($row)use($data){
                    if ($row->kunjungan->status_farmasi == 'resep'){
                        return '<span class="badge badge-danger btn-sm">MASIH DIRESEP</span>';
                    } else if ($row->status == 'belum'){
                        return '<span class="badge badge-danger btn-sm">BELUM DIPROSES</span>';
                    } else if ($row->status == 'diproses'){
                        return '<span class="badge badge-warning btn-sm">DALAM PROSES</span>';
                    } else if ($row->status == 'selesai'){
                        return '<span class="badge badge-success btn-sm">SELESAI DIPROSES</span>';
                    }
                    // if ($row->status == 'belum'){
                    //     return '<span class="badge badge-danger btn-sm">MASIH DIRESEP</span>';
                    // } else {
                    //     // if ($row->kunjungan->status_farmasi == 'resep'){
                    //     //     return '<span class="badge badge-danger btn-sm">MASIH DIRESEP</span>';
                    //     // } else {
                    //         if ($row->status == 'belum'){
                    //             return '<span class="badge badge-danger btn-sm">BELUM DIPROSES</span>';
                    //         } else
                    //         if ($row->status == 'diproses') {
                    //             return '<span class="badge badge-warning btn-sm">DALAM PROSES</span>';
                    //         } else if ($row->status == 'selesai') {
                    //             return '<span class="badge badge-success btn-sm">SELESAI</span>';
                    //         } else if ($row->status == 'batal') {
                    //             return '<span class="badge badge-primary btn-sm">BATAL</span>';
                    //         } else if ($row->kunjungan->status_farmasi == 'resep'){
                    //             return '<span class="badge badge-danger btn-sm">MASIH DIRESEP</span>';
                    //         }
                    //     // }
                    // }

                })
                ->addColumn('action', function($row){
                    if ($row->status != 'selesai'){
                        $btn = '<div class="list-icons d-inline-flex">
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="list-icons-item text-danger me-10 deleteFarmasi" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                        <i class="fad fa-trash-alt fs-20"></i>
                                    </a>
                                </div>';
                        return $btn;
                    }
                })
                ->rawColumns(['action', 'kd_farmasi', 'status', 'obat_id'])
                ->make(true);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Kunjungan::findOrFail($id);
        if ($data->status_farmasi == 'resep' || $data->status_farmasi == null){
            return redirect()->route('admin.farmasi.index');
        } else {
            $obat = Obat::all();
            return view('admin.farmasi.edit', compact('data', 'obat'));
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
        if ($request->obat == 'kosong'){
            $farmasi = Farmasi::findOrFail($request->product_id);
            if ($farmasi->obat_pengganti_id == ''){

            } else {
                $obat = Obat::findOrFail($farmasi->obat_pengganti_id);
                $obat->stok = $obat->stok + $farmasi->jumlah_pengganti;
                $obat->save();
                $obat = Obat::findOrFail($farmasi->obat_id);
                $obat->stok = $obat->stok - $farmasi->jumlah;
                $obat->save();
            }
            $farmasi->update([
                'obat_pengganti_id' => null,
                'jumlah_pengganti' => null,
                'keterangan_pengganti' => '',
                'cara_penggunaan_pengganti' => '',
                'pagi_pengganti' => '0',
                'siang_pengganti' => '0',
                'malam_pengganti' => '0',
            ]);
        } else {
            $farmasi = Farmasi::findOrFail($request->product_id);
            $obat = Obat::findOrFail($request->obat);
            if ($farmasi->obat_id == $request->obat){
                return response()->json('Obat tidak bisa diganti yang sama', 500);
            } else {
                if ($farmasi->obat_pengganti_id == ''){
                    $obat = Obat::findOrFail($farmasi->obat_id);
                    $obat->stok = $obat->stok + $farmasi->jumlah;
                    $obat->save();
                    $obat = Obat::findOrFail($request->obat);
                    $obat->stok = $obat->stok - $request->jumlah;
                    $obat->save();
                } else {
                    $obat = Obat::findOrFail($farmasi->obat_pengganti_id);
                    $obat->stok = $obat->stok + $farmasi->jumlah_pengganti;
                    $obat->save();
                    $obat = Obat::findOrFail($request->obat);
                    $obat->stok = $obat->stok - $request->jumlah;
                    $obat->save();
                }

                $farmasi->update([
                    'obat_pengganti_id' => $request->obat,
                    'keterangan_pengganti' => $request->keterangan,
                    'jumlah_pengganti' => $request->jumlah,
                    'cara_penggunaan_pengganti' => $request->cara,
                    'pagi_pengganti' => $request->pagi,
                    'siang_pengganti' => $request->siang,
                    'malam_pengganti' => $request->malam,
                ]);
            }
        }

        $data = Kunjungan::findOrFail($farmasi->kunjungan_id);
        return view('admin.farmasi.table', compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $farmasi = Farmasi::findOrFail($id);
        $cek = Farmasi::where('kunjungan_id', $farmasi->kunjungan_id)->count();
        if ($cek == 1){
            $kunjungan = Kunjungan::findOrFail($farmasi->kunjungan_id);
            $kunjungan->update([
                'status_farmasi' => null,
                'tgl_order_farmasi' => null,
            ]);
            $obat = Obat::findOrFail($farmasi->obat_id);
            $obat->stok = $obat->stok + $farmasi->jumlah;
            $obat->save();
            Farmasi::findOrFail($id)->delete();
        } else {
            $obat = Obat::findOrFail($farmasi->obat_id);
            $obat->stok = $obat->stok + $farmasi->jumlah;
            $obat->save();
            Farmasi::findOrFail($id)->delete();
        }

        return response()->json('Success');
    }

    public function cetak($id)
    {
        $data = Farmasi::where('kunjungan_id', $id)->get();
        return view('admin.farmasi.cetak', compact('data'));
    }
}
