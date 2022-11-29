<?php

namespace App\Http\Controllers\Admin\Lab;

use App\Http\Controllers\Controller;
use App\Models\HasilLab;
use App\Models\Kunjungan;
use App\Models\Lab;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kunjungan::where('tgl_order_lab', date('Y-m-d'))->whereIn('status_lab', ['belum', 'diproses', 'selesai'])->orderBy('status_lab', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kd_lab', function($row){
                    if ($row->lab){
                        $lab = $row->lab->kd_lab;
                    } else {
                        $lab = '';
                    }
                    return '<a href="'.route('admin.lab.edit', $row->id).'" class="btn btn-sm btn-success" >'.$lab.'</a>';
                })
                ->addColumn('tgl_order', function($row){
                    if ($row->lab){
                        $tgl = $row->lab->tgl_order;
                    } else {
                        $tgl = '';
                    }
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
                        if ($row->lab){
                            $lab = $row->lab->kd_lab;
                        } else {
                            $lab = '';
                        }
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

        $belum = $this->getData('belum');
        $diproses = $this->getData('diproses');
        $selesai = $this->getData('selesai');
        $batal = $this->getData('batal');

        return view('admin.lab.index', compact('belum', 'diproses', 'selesai', 'batal'));
    }

    protected function getData($status)
    {
        // $lab = Lab::where('status', $status)->distinct()->get('register')->count();
        $lab = Kunjungan::where('status_lab', $status)->where('tgl_masuk', date('Y-m-d'))->get()->count();
        return $lab;
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
        $cekLab = Lab::where('kunjungan_id', $request->kunjungan)->whereIn('status', ['belum', 'diproses'])->first();
        if ($cekLab){
            $newID = $cekLab->kd_lab;
            $status = 'diproses';
        } else {
            $lastID = Lab::select('kd_lab')->where('tgl_order', date('Y-m-d'))->orderBy('id', 'desc')->first();
            if (!$lastID){
                $newID = 'LAB-'.date('ymd').'-0001';
            }
            else{
                $lastIncrement = substr($lastID->kd_lab, -4, 4);
                $newID = 'LAB-'.date('ymd').'-'.str_pad($lastIncrement+1, 4, 0, STR_PAD_LEFT);
            }
            $status = 'belum';
        }
        $lab = Lab::where('register', $kunjungan->register)->where('produk_lab_id', $request->produk_lab)->where('status', 'belum')->first();
        if (!$lab){
            $kunjungan->update([
                'status_lab' => $status,
                'tgl_order_lab' => date('Y-m-d'),
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
                'status' => $status,
            ]);
            $hasil = HasilLab::create([
                'lab_id' => $insert->id,
                'kd_lab' => $newID,
                'register' => $kunjungan->register,
                'kunjungan_id' => $kunjungan->id,
                'pasien_id' => $kunjungan->pasien_id,
                'dokter_id' => $kunjungan->dokter_id,
                'user_id' => Auth::user()->id,
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
            $data = Lab::where('kunjungan_id', $id)->orderBy('id', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('kd_lab', function($row){
                    // return '<a href="'.route('admin.lab.edit', $row->id).'" class="btn btn-sm btn-success" >'.$row->kd_lab.'</a>';
                    return '<button type="button" class="btn btn-sm btn-success" >'.$row->kd_lab.'</button>';
                })
                ->editColumn('produk_lab_id', function($row){
                    return $row->produk->nama;
                })
                ->editColumn('status', function($row){
                    if ($row->status == 'belum'){
                        return '<span class="badge badge-danger btn-sm">BELUM DIPROSES</span>';
                    } else if ($row->status == 'diproses') {
                        return '<span class="badge badge-warning btn-sm">DALAM PROSES</span>';
                    } else if ($row->status == 'selesai') {
                        return '<span class="badge badge-success btn-sm">SELESAI</span>';
                    } else if ($row->status == 'batal') {
                        return '<span class="badge badge-danger btn-sm">BATAL</span>';
                    }
                })
                ->addColumn('action', function($row){
                    if ($row->status == 'belum'){
                        $btn = '<div class="list-icons d-inline-flex">
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="list-icons-item text-danger me-10 deleteLab" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                        <i class="fad fa-trash-alt fs-20"></i>
                                    </a>
                                </div>';
                        return $btn;
                    } else if ($row->status == 'selesai'){
                        $btn = '<div class="list-icons d-inline-flex">
                                    <a href="'.env('APP_URL').'/layanan/hasil_lab/'.$row->kd_lab.'" target="_blank" data-id="'.$row->id.'" class="list-icons-item text-dark me-10 hasilLabPDF" data-bs-toggle="tooltip" data-bs-placement="top" title="Hasil">
                                        <i class="fad fa-print fs-20"></i>
                                    </a>
                                </div>';
                        return $btn;
                    }
                })
                ->rawColumns(['action', 'kd_lab', 'status'])
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
        return view('admin.lab.edit', compact('data'));
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
        dd($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lab = Lab::findOrFail($id);
        $cek = Lab::where('kunjungan_id', $lab->kunjungan_id)->count();
        if ($cek == 1){
            $kunjungan = Kunjungan::findOrFail($lab->kunjungan_id);
            $kunjungan->update([
                'status_lab' => null,
            ]);
            $hasil = HasilLab::where('lab_id', $id)->first()->delete();
            $lab->delete();
        } else {
            $lab->delete();
            $hasil = HasilLab::where('lab_id', $id)->first()->delete();
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
}
