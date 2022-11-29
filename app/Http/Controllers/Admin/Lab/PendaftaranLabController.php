<?php

namespace App\Http\Controllers\Admin\Lab;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\Asuransi;
use App\Models\Dokter;
use App\Models\Gender;
use App\Models\HasilLab;
use App\Models\KategoriRujukan;
use App\Models\Kunjungan;
use App\Models\Lab;
use App\Models\Pasien;
use App\Models\PasienBpjs;
use App\Models\Pekerjaan;
use App\Models\Poliklinik;
use App\Models\Produk;
use App\Models\Provinsi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PendaftaranLabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kunjungan::where('status_kunjungan', 'rwj')->where('tgl_masuk', date('Y-m-d'))->where('poliklinik_id', 4)->orderBy('jam_masuk', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('register', function($row){
                    return '<a href="'.route('admin.rawat-jalan.edit', $row->id).'" class="btn btn-sm btn-success" >'.$row->register.'</a>';
                })
                ->editColumn('no_rm', function($row){
                    $gender = $row->pasien->gender->alias;
                    return $row->no_rm . '<br>' . ' (' . $gender . ' / ' .Carbon::parse($row->pasien->tgl_lahir)->age .' Thn )';
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
                    $url = env('APP_URL').'/layanan/surat_lab/'.$row->id;
                    $btn = '<div class="list-icons d-inline-flex">
                                    <a href="'.$url.'"  data-id="'.$row->id.'" target="_blank" class="list-icons-item text-dark me-10" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak">
                                        <i class="fad fa-print fs-20"></i>
                                    </a>
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="list-icons-item text-danger me-10 deleteProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                        <i class="fad fa-trash-alt fs-20"></i>
                                    </a>
                                </div>';
                    return $btn;
                })
                ->rawColumns(['action', 'register', 'status_jaminan', 'no_rm'])
                ->make(true);
        }

        return view('admin.pendaftaran.lab.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rujukan = KategoriRujukan::all();
        $poli = Poliklinik::where('status', 'aktif')->get();
        $asuransi = Asuransi::all();
        $pekerjaan = Pekerjaan::all();
        $gender = Gender::all();
        $provinsi = Provinsi::all();
        $produkLab = Produk::where('kategori_produk_id', 2)->get();
        $dokter = Dokter::all();
        return view('admin.pendaftaran.lab.create', compact('rujukan', 'poli',
                'asuransi', 'pekerjaan', 'gender', 'provinsi', 'produkLab', 'dokter'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
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
        $poli = Poliklinik::where('nama', 'Laboratorium')->first();
        $kunjungan = Kunjungan::create([
            'no_rm' => $pasien->no_rm,
            'register' => $newID,
            'tgl_masuk' => date('Y-m-d'),
            'dokter_id' => $request->dokter,
            'pasien_id' => $pasien->id,
            'poliklinik_id' => $poli->id,
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

        $kunjungan = Kunjungan::findOrFail($kunjungan->id);
        $cekLab = Lab::where('kunjungan_id', $kunjungan->id)->first();
        if ($cekLab){
            $newID = $cekLab->kd_lab;
        } else {
            $lastID = Lab::select('kd_lab')->where('tgl_order', date('Y-m-d'))->orderBy('id', 'desc')->first();
            if (!$lastID){
                $newID = 'LAB-'.date('ymd').'-0001';
            }
            else{
                $lastIncrement = substr($lastID->kd_lab, -4, 4);
                $newID = 'LAB-'.date('ymd').'-'.str_pad($lastIncrement+1, 4, 0, STR_PAD_LEFT);
            }
        }
        $lab = Lab::where('register', $kunjungan->register)->where('produk_lab_id', $request->produk_lab)->first();
        if (!$lab){
            $kunjungan->update([
                'status_lab' => 'belum'
            ]);

            $insert = Lab::updateOrCreate(
                ['id' => $request->catatan]
                ,[
                'register' => $kunjungan->register,
                'kunjungan_id' => $kunjungan->id,
                'pasien_id' => $kunjungan->pasien_id,
                'dokter_id' => $kunjungan->dokter_id,
                'user_id' => Auth::user()->id,
                'tgl_masuk' => $kunjungan->tgl_masuk,
                'produk_lab_id' => $request->produk_lab,
                'kd_lab' => $newID,
                'tgl_order' => date('Y-m-d'),
                'status' => 'belum',
            ]);
            $lastID = HasilLab::select('nomor_surat')->whereRaw('right(nomor_surat, 4) = ?', [date('Y')])->orderBy('nomor_surat', 'desc')->first();
            if (!$lastID){
                $newID = "01/LAB/".$this->bulan_romawi(date("m"))."/".date("Y");
            }
            else{
                $no_surat = explode("/", $lastID->nomor_surat)[0]+1;
                $newID = sprintf("%02s", $no_surat)."/LAB/".$this->bulan_romawi(date("m"))."/".date("Y");
            }
            $hasil = HasilLab::create([
                'lab_id' => $insert->id,
                'kd_lab' => $insert->kd_lab,
                'register' => $kunjungan->register,
                'kunjungan_id' => $kunjungan->id,
                'pasien_id' => $kunjungan->pasien_id,
                'dokter_id' => $kunjungan->dokter_id,
                'user_id' => Auth::user()->id,
                'nomor_surat' => $newID,
                'hasil' => $request->hasil_lab,
                'jam_hasil' => date('Y-m-d H:i:s'),
            ]);
        }

        return response()->json('Success');
    }

    protected function bulan_romawi($bln)
    {
        $bulan_romawi = [
            '01' => 'I',
            '02' => 'II',
            '03' => 'III',
            '04' => 'IV',
            '05' => 'V',
            '06' => 'VI',
            '07' => 'VII',
            '08' => 'VIII',
            '09' => 'IX',
            '10' => 'X',
            '11' => 'XI',
            '12' => 'XII',
        ];
        return $bulan_romawi[$bln];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
