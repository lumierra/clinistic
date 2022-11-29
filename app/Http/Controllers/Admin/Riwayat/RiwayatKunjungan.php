<?php

namespace App\Http\Controllers\Admin\Riwayat;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RiwayatKunjungan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pasien::orderBy('id', 'asc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('nama', function($row){
                    $nama = '<span class="fw-bolder">Nama : </span>' . ucfirst($row->nama);
                    $nik = '<span class="fw-bolder">NIK : </span>' . $row->nik ?? '-';
                    $bpjs = '<span class="fw-bolder">BPJS : </span>' . $row->getBpjs($row->id) ?? '-';
                    $result = $nama . '<br>' . $nik . '<br>' . $bpjs;
                    return $result;
                })
                ->editColumn('no_rm', function($row){
                    return '<span class="btn btn-sm btn-success">'.$row->no_rm.'</span>';
                })
                ->editColumn('gender_id', function($row){
                    if ($row->gender->jenis_kelamin == 'Pria'){
                        return '<span class="badge badge-info">'.$row->gender->jenis_kelamin.'</span>';
                    } else {
                        return '<span class="badge badge-danger">'.$row->gender->jenis_kelamin.'</span>';
                    }
                })
                ->editColumn('tgl_lahir', function($row){
                    return Carbon::parse($row->tgl_lahir)->age . ' Thn';
                })
                ->editColumn('alamat', function($row){
                    $alamat = '<span>Alamat : </span>' . $row->alamat;
                    if ($row->kelurahan){
                        $kel = $row->kelurahan->nama_kelurahan . ',';
                    } else {
                        $kel = '-';
                    }
                    if ($row->kecamatan){
                        $kec = $row->kecamatan->nama_kecamatan . ',';
                    } else {
                        $kec = '-';
                    }
                    if ($row->kota){
                        $kota = $row->kota->nama_kota . ',';
                    } else {
                        $kota = '-';
                    }
                    if ($row->provinsi){
                        $prov = $row->provinsi->nama_provinsi;
                    } else {
                        $prov = '-';
                    }
                    $result = $alamat . '<br>' . $kel . '<br>' . $kec . '<br>' . $kota . '<br>' . $prov;
                    return $result;
                })
                ->addColumn('action', function($row){
                    // $btn = '<div class="list-icons d-inline-flex">
                    //                 <a href="javascript:void(0)"  data-id="'.$row->id.'" class="list-icons-item text-warning me-10 asuransiProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Asuransi">
                    //                     <i class="fad fa-plus-octagon"></i>
                    //                 </a>
                    //                 <a href="javascript:void(0)"  data-id="'.$row->id.'" class="list-icons-item me-10 editProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                    //                     <i class="fad fa-edit"></i>
                    //                 </a>
                    //                 <a href="javascript:void(0)" data-id="'.$row->id.'" class="list-icons-item text-danger me-10 deleteProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                    //                     <i class="fad fa-trash-alt"></i>
                    //                 </a>
                    //             </div>';
                    // return $btn;
                })
                ->rawColumns(['action', 'alamat', 'no_rm', 'gender_id', 'nama'])
                ->make(true);
        }

        return view('admin.riwayat.kunjungan.index');
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
        //
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
            $data = Kunjungan::where('status_kunjungan', 'rwj')->where('tgl_masuk', $id)->where('poliklinik_id', '!=', 4)->orderBy('jam_masuk', 'asc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('register', function($row){
                    return '<a href="'.route('admin.layanan-rwj.show', $row->id).'" class="btn btn-sm btn-success" >'.$row->register.'</a>';
                })
                ->editColumn('no_rm', function($row){
                    $gender = $row->pasien->gender->alias;
                    return $row->no_rm . '<br>' . ' (' . $gender . ' / ' .Carbon::parse($row->pasien->tgl_lahir)->age .' Thn )';
                })
                ->editColumn('tanggal', function($row){
                    return Carbon::parse($row->jam_masuk)->format('d/m/Y H:i') . ' WIB';
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
                ->editColumn('status_pasien', function($row){
                    if ($row->status_pasien == 'belum_selesai'){
                        $pelayanan = 'Pelayanan : <span class="badge badge-danger">Belum Dilayani</span>';
                    } else if ($row->status_pasien == 'diproses') {
                        $pelayanan = 'Pelayanan : <span class="badge badge-warning">Sedang Dilayani</span>';
                    } else {
                        $pelayanan = 'Pelayanan : <span class="badge badge-success">Sudah Dilayani</span>';
                    }
                    if ($row->status_farmasi == ''){
                        $farmasi = '';
                    } else if ($row->status_farmasi == 'belum'){
                        $farmasi = 'Farmasi : <span class="badge badge-danger">Belum Diproses</span>';
                    } else if ($row->status_farmasi == 'diproses'){
                        $farmasi = 'Farmasi : <span class="badge badge-primary">Sedang Diproses</span>';
                    } else {
                        $farmasi = 'Farmasi : <span class="badge badge-success">Sudah Diproses</span>';
                    }
                    if ($row->status_lab == ''){
                        $lab = '';
                    } else if ($row->status_lab == 'belum'){
                        $lab = 'Lab : <span class="badge badge-danger">Belum Diproses</span>';
                    } else if ($row->status_lab == 'diproses'){
                        $lab = 'Lab : <span class="badge badge-primary">Sedang Diproses</span>';
                    } else {
                        $lab = 'Lab : <span class="badge badge-success">Sudah Diproses</span>';
                    }
                    if ($row->status_radiologi == ''){
                        $radiologi = '';
                    } else if ($row->status_radiologi == 'belum'){
                        $radiologi = 'Radiologi : <span class="badge badge-danger">Belum Diproses</span>';
                    } else if ($row->status_radiologi == 'diproses'){
                        $radiologi = 'Radiologi : <span class="badge badge-primary">Sedang Diproses</span>';
                    } else {
                        $radiologi = 'Radiologi : <span class="badge badge-success">Sudah Diproses</span>';
                    }
                    if ($row->catatan){
                        if ($row->catatan->surat_keterangan == '' || $row->catatan->surat_keterangan == 'tidak_ada'){
                            $surat = '';
                        } else if ($row->catatan->surat_keterangan == 'surat_sakit'){
                            $url = env('APP_URL').'/layanan/surat_sakit/'.$row->id;
                            $surat = 'Surat : <a href="'.$url.'" target="_blank" class="badge badge-danger">Surat Sakit</a>';
                        } else if ($row->catatan->surat_keterangan == 'surat_sehat'){
                            $url = env('APP_URL').'/layanan/surat_sehat/'.$row->id;
                            $surat = 'Surat : <a href="'.$url.'" target="_blank" class="badge badge-danger">Surat Sehat</a>';
                        } else if ($row->catatan->surat_keterangan == 'surat_berobat') {
                            $url = env('APP_URL').'/layanan/surat_berobat/'.$row->id;
                            $surat = 'Surat : <a href="'.$url.'" target="_blank" class="badge badge-danger">Surat Berobat</a>';
                        }
                    } else {
                        $surat = '';
                    }

                    return $pelayanan . '<br>' . $farmasi . '<br>' . $lab . '<br>' . $radiologi . '<br>' . $surat;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('admin.layanan-rwj.show', $row->id).'" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Input Pelayanan">
                                <span class="fad fa-arrow-from-left fs-15"></span>
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </a>';
                    return $btn;
                })
                ->rawColumns(['action', 'register', 'status_jaminan', 'no_rm', 'status_pasien'])
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
