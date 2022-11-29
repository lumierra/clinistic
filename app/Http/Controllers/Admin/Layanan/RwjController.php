<?php

namespace App\Http\Controllers\Admin\Layanan;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\AsalRujukan;
use App\Models\Asuransi;
use App\Models\Catatan;
use App\Models\DetailTransaksi;
use App\Models\Dokter;
use App\Models\Gender;
use App\Models\KategoriRujukan;
use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\PasienBpjs;
use App\Models\Pekerjaan;
use App\Models\Poliklinik;
use App\Models\Produk;
use App\Models\Provinsi;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class RwjController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kunjungan::where('status_kunjungan', 'rwj')->where('tgl_masuk', date('Y-m-d'))->where('poliklinik_id', '!=', 4)->orderBy('jam_masuk', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('register', function($row){
                    // return '<a href="'.route('admin.rawat-jalan.edit', $row->id).'" class="btn btn-sm btn-success" >'.$row->register.'</a>';
                    return '<button type="button" class="btn btn-sm btn-success copyrm" data-original-title="hi">'.$row->register.'</button>';
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
                ->editColumn('tanggal', function($row){
                    return Carbon::parse($row->jam_masuk)->format('d/m/Y H:i');
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
                ->editColumn('status_jaminan', function($row){
                    if ($row->status_jaminan == 'umum'){
                        return '<span class="badge badge-info">'.$row->status_jaminan.'</span>';
                    } else {
                        return '<span class="badge badge-danger">'.$row->asuransi->nama.'</span>';
                    }
                })
                ->addColumn('action', function($row){
                    $poli = Poliklinik::where('nama', 'ESTETIKA')->first();
                    if ($row->poliklinik_id == $poli->id){
                        $url = route('admin.estetika.show', $row->id);
                    } else {
                        $url = route('admin.layanan-rwj.show', $row->id);
                    }
                    if ($row->status_pasien == 'belum_selesai'){
                        $edit = '<a href="javascript:void(0)"  data-id="'.$row->id.'" class="list-icons-item text-success me-10 editPendaftaran" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    <i class="fad fa-file-pen fs-20"></i>
                                </a>';
                    } else {
                        $edit = '';
                    }
                    $btn = '<div class="list-icons d-inline-flex">
                                    <a href="'.$url.'"  data-id="'.$row->id.'" class="list-icons-item text-primary me-10" data-bs-toggle="tooltip" data-bs-placement="top" title="Pelayanan">
                                        <i class="fad fa-file-medical fs-20"></i>
                                    </a>
                                    '.$edit.'
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="list-icons-item text-danger me-10 deletePendaftaran" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                        <i class="fad fa-trash-alt fs-20"></i>
                                    </a>
                                </div>';
                    return $btn;
                })
                ->rawColumns(['action', 'register', 'status_jaminan', 'no_rm'])
                ->make(true);
        }

        $asuransi = Kunjungan::where('tgl_masuk', date('Y-m-d'))->where('status_jaminan', 'asuransi')->get()->count();
        $umum = Kunjungan::where('tgl_masuk', date('Y-m-d'))->where('status_jaminan', 'umum')->get()->count();
        $poli = Poliklinik::where('status', 'aktif')->where('id', '!=', 4)->get();
        $dataAsuransi = Asuransi::all();

        return view('admin.pendaftaran.rwj.index', compact('asuransi', 'umum', 'poli', 'dataAsuransi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rujukan = KategoriRujukan::all();
        $poli = Poliklinik::where('status', 'aktif')->where('id', '!=', 4)->get();
        $asuransi = Asuransi::all();
        $pekerjaan = Pekerjaan::all();
        $gender = Gender::all();
        $provinsi = Provinsi::all();
        return view('admin.pendaftaran.rwj.create', compact('rujukan', 'poli',
                'asuransi', 'pekerjaan', 'gender', 'provinsi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cekKunjungan = Kunjungan::where('no_rm', $request->rm)->where('tgl_masuk', date('Y-m-d'))->first();
        if ($cekKunjungan){
            return response()->json([
                'status' => 201,
                'message' => 'Pasien Sudah Terdaftar Hari Ini'
            ]);
        } else {
            $pasien = Pasien::where('no_rm', $request->rm)->first();
            if ($request->jaminan == 'umum'){
                $status = 'umum';
                $asuransi = 0;
            } else {
                $status = 'asuransi';
                $asuransi = $request->asuransi2;
            }
            $lastID = Kunjungan::select('register')->where('tgl_masuk', date('Y-m-d'))->orderBy('id', 'desc')->first();
            if (!$lastID){
                $newID = 'RJL-'.date('ymd').'-0001';
            }
            else{
                $lastIncrement = substr($lastID->register, -4, 4);
                $newID = 'RJL-'.date('ymd').'-'.str_pad($lastIncrement+1, 4, 0, STR_PAD_LEFT);
            }
            $kunjungan = Kunjungan::create([
                'no_rm' => $pasien->no_rm,
                'register' => $newID,
                'tgl_masuk' => date('Y-m-d'),
                'dokter_id' => $request->dokter,
                'pasien_id' => $pasien->id,
                'kategori_rujukan_id' => $request->jenis_rujukan,
                'asal_rujukan_id' => $request->asal_rujukan,
                'poliklinik_id' => $request->poliklinik,
                'daftar_user_id' => Auth::user()->id,
                'status_jaminan' => $status,
                'asuransi_id' => $asuransi,
                'status_kunjungan' => 'rwj',
                'jam_masuk' => date('Y-m-d H:i:s'),
                'keluhan_awal' => $request->keluhan,
                'status_pasien' => 'belum_selesai',
            ]);

            if ($status == 'asuransi'){
                $cariBpjs = PasienBpjs::where('asuransi_id', $asuransi)->where('pasien_id', $pasien->id)->first();
                if (!$cariBpjs){
                    $bpjs = PasienBpjs::create([
                        'asuransi_id' => $asuransi,
                        'pasien_id' => $pasien->id,
                        'nomor' => $request->no_kartu,
                    ]);
                }
            }

            $poli = Poliklinik::findOrFail($request->poliklinik);
            $cekAntrian = Antrian::where('poliklinik_id', $request->poliklinik)->where('tanggal', date('Y-m-d'))->orderBy('nomor_antrian', 'desc')->first();
            if (!$cekAntrian){
                $newAntrian = $poli->nomor_antrian;
            }
            else{
                $lastIncrement = substr($cekAntrian->nomor_antrian, -3, 3);
                $format = substr($poli->nomor_antrian, 0, 1);
                $newAntrian = $format.str_pad($lastIncrement+1, 3, 0, STR_PAD_LEFT);
            }

            $insertAntrian = Antrian::create([
                'tanggal' => date('Y-m-d'),
                'nomor_antrian' => $newAntrian,
                'kunjungan_id' => $kunjungan->id,
                'pasien_id' => $pasien->id,
                'poliklinik_id' => $request->poliklinik,
                'dokter_id' => $request->dokter,
                'panggil' => 0,
                'waktu_panggil' => null,
                'status' => 'menunggu',
            ]);

            $this->transaksi($kunjungan);

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil Menambahkan Data'
            ]);
        }
    }

    protected function transaksi($kunjungan)
    {
        $cekTransaksi = Transaksi::where('kunjungan_id', $kunjungan->id)->first();
        if (!$cekTransaksi){
            $lastID = Transaksi::select('no_transaksi')->orderBy('id', 'desc')->first();
            if (!$lastID){
                $newID = 'T0000001';
            }
            else{
                $lastIncrement = substr($lastID->no_transaksi, -7, 7);
                $newID = 'T'.str_pad($lastIncrement+1, 7, 0, STR_PAD_LEFT);
            }
            $transaksi = Transaksi::create([
                'no_transaksi' => $newID,
                'no_rm' => $kunjungan->no_rm,
                'register' => $kunjungan->register,
                'tgl_masuk' => $kunjungan->tgl_masuk,
                'kunjungan_id' => $kunjungan->id,
                'dokter_id' => $kunjungan->dokter_id,
                'pasien_id' => $kunjungan->pasien_id,
                'poliklinik_id' => $kunjungan->poliklinik_id,
                'user_id' => Auth::user()->id,
                'status_jaminan' => $kunjungan->status_jaminan,
                'asuransi_id' => $kunjungan->asuransi_id,
                'status_transaksi' => 'belum_selesai',
                'tgl_transaksi' => date('Y-m-d'),
            ]);

            $produk = Produk::where('poliklinik_id', $kunjungan->poliklinik_id)->first();
            $detailTransaksi = DetailTransaksi::create([
                'no_transaksi' => $transaksi->no_transaksi,
                'no_rm' => $kunjungan->no_rm,
                'register' => $kunjungan->register,
                'tgl_masuk' => $kunjungan->tgl_masuk,
                'transaksi_id' => $transaksi->id,
                'kunjungan_id' => $kunjungan->id,
                'dokter_id' => $kunjungan->dokter_id,
                'pasien_id' => $kunjungan->pasien_id,
                'poliklinik_id' => $kunjungan->poliklinik_id,
                'user_id' => Auth::user()->id,
                'produk_id' => $produk->id,
                'jumlah' => 1,
                'harga' => $produk->harga,
                'urut' => 1,
                'tgl_detail' => date('Y-m-d'),
                'keterangan' => 'pendaftaran',
            ]);
        }
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
            $data = Kunjungan::where('status_kunjungan', 'rwj')->where('tgl_masuk', $id)->where('poliklinik_id', '!=', 4)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('register', function($row){
                    return '<a href="'.route('admin.rawat-jalan.edit', $row->id).'" class="btn btn-sm btn-success" >'.$row->register.'</a>';
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
                ->editColumn('tanggal', function($row){
                    return Carbon::parse($row->jam_masuk)->format('d/m/Y H:i');
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
                ->editColumn('status_jaminan', function($row){
                    if ($row->status_jaminan == 'umum'){
                        return '<span class="badge badge-info">'.$row->status_jaminan.'</span>';
                    } else {
                        return '<span class="badge badge-danger">'.$row->asuransi->nama.'</span>';
                    }
                })
                ->addColumn('action', function($row){
                    $poli = Poliklinik::where('nama', 'ESTETIKA')->first();
                    if ($row->poliklinik_id == $poli->id){
                        $url = route('admin.estetika.show', $row->id);
                    } else {
                        $url = route('admin.layanan-rwj.show', $row->id);
                    }
                    if ($row->status_pasien == 'belum_selesai'){
                        $edit = '<a href="javascript:void(0)"  data-id="'.$row->id.'" class="list-icons-item text-success me-10 editPendaftaran" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    <i class="fad fa-file-pen fs-20"></i>
                                </a>';
                    } else {
                        $edit = '';
                    }
                    $btn = '<div class="list-icons d-inline-flex">
                                    <a href="'.$url.'"  data-id="'.$row->id.'" class="list-icons-item text-primary me-10" data-bs-toggle="tooltip" data-bs-placement="top" title="Pelayanan">
                                        <i class="fad fa-file-medical fs-20"></i>
                                    </a>
                                    '.$edit.'
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="list-icons-item text-danger me-10 deleteProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                        <i class="fad fa-trash-alt fs-20"></i>
                                    </a>
                                </div>';
                    return $btn;
                })
                ->rawColumns(['action', 'register', 'status_jaminan', 'no_rm'])
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
        $kunjungan = Kunjungan::findOrFail($id);
        return response()->json($kunjungan);
        // $rujukan = KategoriRujukan::all();
        // $poli = Poliklinik::where('status', 'aktif')->get();
        // $asuransi = Asuransi::all();
        // $asalRujukan = AsalRujukan::where('kategori_rujukan_id', $kunjungan->kategori_rujukan_id)->get();
        // $dokter = Dokter::where('poliklinik_id', $kunjungan->poliklinik_id)->get();
        // return view('admin.pendaftaran.rwj.edit', compact('rujukan', 'poli', 'asuransi',
        //         'kunjungan', 'asalRujukan', 'dokter'));
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
        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->update([
            'dokter_id' => $request->dokter,
            'asal_rujukan_id' => $request->asal_rujukan,
            'poliklinik_id' => $request->poliklinik,
            'status_jaminan' => $request->jaminan,
            'asuransi_id' => $request->asuransi,
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
        $kunjungan = Kunjungan::where('id', $id)->where('status_pasien', 'belum_selesai')->first();
        if ($kunjungan){
            $kunjungan = Kunjungan::findOrFail($id)->delete();
            $antrian = Antrian::where('kunjungan_id', $id)->first()->delete();
            return response()->json('Success');
        } else {
            return response()->json('error');
        }
    }
}
