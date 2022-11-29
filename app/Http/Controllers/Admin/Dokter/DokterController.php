<?php

namespace App\Http\Controllers\Admin\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\DokterPoliklinik;
use App\Models\Gender;
use App\Models\Kunjungan;
use App\Models\Poliklinik;
use App\Models\Provinsi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        if ($request->ajax()) {
            $data = Dokter::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('gender_id', function($row){
                    return $row->gender->jenis_kelamin;
                })
                ->editColumn('status', function($row){
                    if ($row->status == 'aktif'){
                        return '<span class="badge badge-success">Aktif</span>';
                    } else {
                        return '<span class="badge badge-danger">Tidak Aktif</span>';
                    }
                })
                ->editColumn('alamat', function($row){
                    $alamat = '<span>Alamat : </span>' . $row->alamat;
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
                    $result = $alamat . '<br>' . $kec . '<br>' . $kota . '<br>' . $prov;
                    return $result;
                })
                ->editColumn('poliklinik_id', function($row){
                    $color = ['primary', 'success', 'danger', 'warning', 'info'];
                    $data = $row->dokterpoli;
                    $result = '';
                    foreach ($data as $key => $value) {
                        $result .= '<span class="mx-2 badge bg-'.$color[$key].'">'.$value->poliklinik->nama.'</span>';
                    }
                    return $result;
                })
                ->addColumn('action', function($row){
                    $btn = '<div class="list-icons d-inline-flex">
                                    <a href="javascript:void(0)"  data-id="'.$row->id.'" class="list-icons-item me-10 text-dark editProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit File">
                                        <i class="fad fa-edit fs-20"></i>
                                    </a>
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="list-icons-item me-10 text-danger deleteProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus File">
                                        <i class="fad fa-trash-alt fs-20"></i>
                                    </a>
                                </div>';
                    return $btn;
                })
                ->rawColumns(['action', 'status', 'alamat', 'poliklinik_id'])
                ->make(true);
        }

        $gender = Gender::all();
        $poli = Poliklinik::where('status', 'aktif')->get();
        $provinsi = Provinsi::all();

        return view('admin.dokter.index', compact('gender', 'poli', 'provinsi'));
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
        $dokter = Dokter::updateOrCreate(
            ['id' => $request->product_id],
            [
                // 'poliklinik_id' => $request->poliklinik,
                'nama' => $request->nama,
                'gender_id' => $request->gender,
                'phone' => $request->phone,
                'no_izin' => $request->izin,
                'alamat' => $request->alamat,
                'provinsi_id' => $request->provinsi,
                'kota_id' => $request->kota,
                'kecamatan_id' => $request->kecamatan,
                'status' => $request->status,
            ]
        );
        $dokterpoli = DokterPoliklinik::where('dokter_id', $dokter->id)->get();
        foreach ($dokterpoli as $item){
            $item->delete();
        }
        foreach ($request->poliklinik as $item){
            DokterPoliklinik::create([
                'dokter_id' => $dokter->id,
                'poliklinik_id' => $item,
            ]);
        }
        if ($request->buat == 'create'){
            $email = str_replace(' ','', $request->nama);
            User::create([
                'role_id' => 4,
                // 'poliklinik_id' => $request->poliklinik,
                'username' => $request->nama,
                'name' => $request->nama,
                'email' => $email . '@mail.com',
                'phone' => $request->phone,
                'password' => Hash::make('12345'),
                'dokter_id' => $dokter->id,
            ]);
        } else {
            $user = User::where('dokter_id', $dokter->id)->first();
            $user->update([
                'name' => $request->nama,
                'dokter_id' => $dokter->id,
            ]);
        }
        return response()->json(['success' => 'Berhasil disimpan.']);
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
        // dokter dan dokter_poliklinik query
        $dokter = Dokter::where('id', $id)->with('dokterpoli')->first();
        return response()->json($dokter);
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
        $cek = Kunjungan::where('dokter_id', $id)->first();
        if ($cek){
            return response()->json(['status'=>201,'error' => 'Dokter tidak dapat dihapus karena sudah terdaftar pada kunjungan.']);
        } else {
            Dokter::find($id)->delete();
            return response()->json(['status'=>200,'success' => 'Berhasil dihapus.']);
        }
    }
}
