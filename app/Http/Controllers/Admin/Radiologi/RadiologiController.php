<?php

namespace App\Http\Controllers\Admin\Radiologi;

use App\Http\Controllers\Controller;
use App\Models\HasilRadiologi;
use App\Models\Kunjungan;
use App\Models\Radiologi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class RadiologiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kunjungan::where('tgl_order_rad', date('Y-m-d'))->whereIn('status_radiologi', ['belum', 'diproses', 'selesai'])->orderBy('status_radiologi', 'asc')->get();
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
                        return '<span class="badge badge-warning">SEDANG DIPROSES</span>';
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

        $belum = $this->getData('belum');
        $diproses = $this->getData('diproses');
        $selesai = $this->getData('selesai');
        $batal = $this->getData('batal');

        return view('admin.radiologi.index', compact('belum', 'diproses', 'selesai', 'batal'));
    }

    protected function getData($status)
    {
        $radiologi = Kunjungan::where('status_radiologi', $status)->where('tgl_masuk', date('Y-m-d'))->get()->count();
        return $radiologi;
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
        $cekRadiologi = Radiologi::where('kunjungan_id', $request->kunjungan)->where('status', 'belum')->first();
        if ($cekRadiologi){
            $newID = $cekRadiologi->kd_rad;
        } else {
            $lastID = Radiologi::select('kd_rad')->where('tgl_order', date('Y-m-d'))->orderBy('id', 'desc')->first();
            if (!$lastID){
                $newID = 'RAD-'.date('ymd').'-0001';
            }
            else{
                $lastIncrement = substr($lastID->kd_rad, -4, 4);
                $newID = 'RAD-'.date('ymd').'-'.str_pad($lastIncrement+1, 4, 0, STR_PAD_LEFT);
            }
        }
        $radiologi = Radiologi::where('register', $kunjungan->register)->where('produk_rad_id', $request->produk_rad)->where('status', 'belum')->first();
        if (!$radiologi){
            $kunjungan->update([
                'status_radiologi' => 'belum',
                'tgl_order_rad' => date('Y-m-d')
            ]);
            $insert = Radiologi::updateOrCreate(
                ['id' => $request->catatan]
                ,[
                'register' => $kunjungan->register,
                'kunjungan_id' => $kunjungan->id,
                'pasien_id' => $kunjungan->pasien_id,
                'dokter_id' => $kunjungan->dokter_id,
                'user_id' => Auth::user()->id,
                'tgl_masuk' => $kunjungan->tgl_masuk,
                'produk_rad_id' => $request->produk_rad,
                'kd_rad' => $newID,
                'tgl_order' => date('Y-m-d'),
                'status' => 'belum',
            ]);
            $hasil = HasilRadiologi::create([
                'radiologi_id' => $insert->id,
                'kd_radiologi' => $newID,
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
            $data = Radiologi::where('kunjungan_id', $id)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('kd_rad', function($row){
                    // return '<a href="'.route('admin.radiologi.edit', $row->kunjungan_id).'" class="btn btn-sm btn-success" >'.$row->kd_rad.'</a>';
                    return '<button type="button" class="btn btn-sm btn-success" >'.$row->kd_rad.'</button>';
                })
                ->editColumn('produk_rad_id', function($row){
                    return $row->produk->nama;
                })
                ->editColumn('status', function($row){
                    if ($row->status == 'belum'){
                        return '<span class="badge badge-danger btn-sm">BELUM DIPROSES</span>';
                    } else if ($row->status == 'diproses') {
                        return '<span class="badge badge-warning btn-sm">SEDANG DIPROSES</span>';
                    } else if ($row->status == 'selesai') {
                        return '<span class="badge badge-success btn-sm">SELESAI</span>';
                    } else if ($row->status == 'batal') {
                        return '<span class="badge badge-danger btn-sm">BATAL</span>';
                    }
                })
                ->addColumn('action', function($row){
                    if ($row->status == 'belum'){
                        $btn = '<div class="list-icons d-inline-flex">
                                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="list-icons-item text-danger me-10 deleteRad" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                            <i class="fad fa-trash-alt fs-20"></i>
                                        </a>
                                    </div>';
                        return $btn;
                    } else if ($row->status == 'selesai'){
                        $btn = '<div class="list-icons d-inline-flex">
                                    <a href="'.env('APP_URL').'/layanan/hasil_radiologi/'.$row->id.'" target="_blank" data-id="'.$row->id.'" class="list-icons-item text-dark me-10 hasilLabPDF" data-bs-toggle="tooltip" data-bs-placement="top" title="Hasil">
                                        <i class="fad fa-print fs-20"></i>
                                    </a>
                                </div>';
                        return $btn;
                    }
                })
                ->rawColumns(['action', 'kd_rad', 'status'])
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
        return view('admin.radiologi.edit', compact('data'));
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
        $radiologi = Radiologi::findOrFail($id);
        $kunjungan = Kunjungan::where('register', $radiologi->register)->first();
        $cekRadiologi = Radiologi::where('kunjungan_id', $kunjungan->id)->get();
        if (count($cekRadiologi) == 1){
            $kunjungan->update([
                'status_radiologi' => ''
            ]);
            $radiologi->delete();
            HasilRadiologi::where('radiologi_id', $id)->delete();
        } else {
            $radiologi->delete();
            HasilRadiologi::where('radiologi_id', $id)->delete();
        }

        return response()->json('Success');
    }
}
