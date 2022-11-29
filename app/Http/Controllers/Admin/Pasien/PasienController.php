<?php

namespace App\Http\Controllers\Admin\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Asuransi;
use App\Models\Gender;
use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\PasienBpjs;
use App\Models\Pekerjaan;
use App\Models\Provinsi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
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
                        return '<span class="btn btn-sm btn-success detailPasien" data-id="'.$row->no_rm.'">'.$row->no_rm.'</span>';
                })
                ->editColumn('no_rm_old', function($row){
                    if ($row->no_rm_old == ''){
                        return '';
                    } else {
                        return '<span class="btn btn-sm btn-warning detailPasien" data-id="'.$row->no_rm.'">'.$row->no_rm_old.'</span>';
                    }
                })
                ->editColumn('gender_id', function($row){
                    if ($row->gender->jenis_kelamin == 'Laki-laki'){
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
                    $btn = '<div class="list-icons d-inline-flex">
                                    <a href="javascript:void(0)"  data-id="'.$row->id.'" class="list-icons-item text-warning me-10 asuransiProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Asuransi">
                                        <i class="fad fa-plus-octagon fs-20"></i>
                                    </a>
                                    <a href="javascript:void(0)"  data-id="'.$row->id.'" class="list-icons-item me-10 editProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                        <i class="fad fa-edit fs-20"></i>
                                    </a>
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="list-icons-item text-danger me-10 deleteProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                        <i class="fad fa-trash-alt fs-20"></i>
                                    </a>
                                </div>';
                    return $btn;
                })
                ->rawColumns(['action', 'alamat', 'no_rm', 'gender_id', 'nama', 'no_rm_old'])
                ->make(true);
        }

        $gender = Gender::all();
        $provinsi = Provinsi::all();
        $pekerjaan = Pekerjaan::all();
        $asuransi = Asuransi::all();

        return view('admin.pasien.index', compact('gender', 'provinsi', 'pekerjaan', 'asuransi'));
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
        if ($request->buat == 'create'){

            $lastID = Pasien::select('no_rm')->orderBy('id', 'desc')->first();
            if (!$lastID){
                $newID = '000001';
            }
            else{
                $lastIncrement = substr($lastID->no_rm, -6, 6);
                $newIncrement = str_pad($lastIncrement + 1, 6, 0, STR_PAD_LEFT);
                $newID = $newIncrement;
            }
            $pasien = Pasien::updateOrCreate(
                ['id' => $request->product_id],
                [
                    'no_rm' => $newID,
                    'nik' => $request->nik,
                    'nama' => $request->nama,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'gender_id' => $request->gender,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'kontak_lain' => $request->kontak_lain,
                    'pekerjaan_id' => $request->pekerjaan,
                    'alamat' => $request->alamat,
                    'provinsi_id' => $request->provinsi,
                    'kota_id' => $request->kota,
                    'kecamatan_id' => $request->kecamatan,
                    'kelurahan_id' => $request->kelurahan,
                    // 'no_bpjs' => $request->bpjs,
                    'status_kawin' => $request->kawin,
                    'golongan_darah' => $request->golongan_darah,
                    'pendidikan' => $request->pendidikan,
                    'nama_ibu' => $request->nama_ibu,
                ]
            );
        } else {
            $pasien = Pasien::updateOrCreate(
                ['id' => $request->product_id],
                [
                    'nik' => $request->nik,
                    'nama' => $request->nama,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'gender_id' => $request->gender,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'kontak_lain' => $request->kontak_lain,
                    'pekerjaan_id' => $request->pekerjaan,
                    'alamat' => $request->alamat,
                    'provinsi_id' => $request->provinsi,
                    'kota_id' => $request->kota,
                    'kecamatan_id' => $request->kecamatan,
                    'kelurahan_id' => $request->kelurahan,
                    // 'no_bpjs' => $request->bpjs,
                    'status_kawin' => $request->kawin,
                    'golongan_darah' => $request->golongan_darah,
                    'pendidikan' => $request->pendidikan,
                    'nama_ibu' => $request->nama_ibu,
                ]
            );
        }

        return response()->json('Success');

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
        $pasien = Pasien::findOrFail($id);
        return response()->json($pasien);
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
        if ($request->buat == 'create'){

            $lastID = Pasien::select('no_rm')->orderBy('id', 'desc')->first();
            if (!$lastID){
                $newID = '000001';
            }
            else{
                $lastIncrement = substr($lastID->no_rm, -6, 6);
                $newIncrement = str_pad($lastIncrement + 1, 6, 0, STR_PAD_LEFT);
                $newID = $newIncrement;
            }
            $pasien = Pasien::updateOrCreate(
                ['id' => $request->product_id],
                [
                    'no_rm' => $newID,
                    'nik' => $request->nik,
                    'nama' => $request->nama,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'gender_id' => $request->gender,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'kontak_lain' => $request->kontak_lain,
                    'pekerjaan_id' => $request->pekerjaan,
                    'alamat' => $request->alamat,
                    'provinsi_id' => $request->provinsi,
                    'kota_id' => $request->kota,
                    'kecamatan_id' => $request->kecamatan,
                    'kelurahan_id' => $request->kelurahan,
                    // 'no_bpjs' => $request->bpjs,
                    'status_kawin' => $request->kawin,
                    'golongan_darah' => $request->golongan_darah,
                    'pendidikan' => $request->pendidikan,
                ]
            );
        } else {
            $pasien = Pasien::updateOrCreate(
                ['id' => $request->product_id],
                [
                    'nik' => $request->nik,
                    'nama' => $request->nama,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'gender_id' => $request->gender,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'kontak_lain' => $request->kontak_lain,
                    'pekerjaan_id' => $request->pekerjaan,
                    'alamat' => $request->alamat,
                    'provinsi_id' => $request->provinsi,
                    'kota_id' => $request->kota,
                    'kecamatan_id' => $request->kecamatan,
                    'kelurahan_id' => $request->kelurahan,
                    // 'no_bpjs' => $request->bpjs,
                    'status_kawin' => $request->kawin,
                    'golongan_darah' => $request->golongan_darah,
                    'pendidikan' => $request->pendidikan,
                ]
            );
        }

        return response()->json($pasien->no_rm);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kunjungan = Kunjungan::where('pasien_id', $id)->first();
        if (!$kunjungan){
            $pasien = Pasien::findOrFail($id);
            $pasien->delete();
            return response()->json('Success');
        } else {
            return response()->json('Error');
        }
    }
}
