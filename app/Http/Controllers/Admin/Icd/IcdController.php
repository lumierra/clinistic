<?php

namespace App\Http\Controllers\Admin\Icd;

use App\Http\Controllers\Controller;
use App\Models\Catatan;
use App\Models\Diagnosa;
use App\Models\Icd;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class IcdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     // $penyakit = DB::select('select * from penyakit');
    //     // foreach ($penyakit as $item){
    //     //     Icd::create([
    //     //         'kode' => $item->KD_PENYAKIT,
    //     //         'nama' => $item->PENYAKIT,
    //     //         'deskripsi' => $item->DESCRIPTION,
    //     //     ]);
    //     // }
    //     // return response()->json('Success');
    // }
    public function index(Request  $request)
    {

        // if ($request->has('q')) {
        //     $cari = $request->q;
        //     $response = DB::table('icd')->select('kode', 'nama', 'deskripsi')
        //                 ->where('kode', 'LIKE', '%'.$cari.'%')->get();

        //     return response()->json($response);
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $response = DB::table('icd')->select('kode', 'nama', 'deskripsi')
                        ->where('kode', 'LIKE', '%'.$cari.'%')
                        ->orWhere('nama', 'LIKE', '%'.$cari.'%')->get();

            return response()->json($response);
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
        $kunjungan = Kunjungan::findOrFail($request->kunjungan);
        $icd = Icd::where('kode', $request->penyakit_icd)->first();
        $cek = Diagnosa::where('kunjungan_id', $kunjungan->id)->get()->count();
        if ($cek < 3){
            $diagnosa = Diagnosa::updateOrCreate(
                ['id' => $request->catatan]
                ,[
                'register' => $kunjungan->register,
                'kunjungan_id' => $kunjungan->id,
                'pasien_id' => $kunjungan->pasien_id,
                'dokter_id' => $kunjungan->dokter_id,
                'user_id' => Auth::user()->id,
                'tgl_masuk' => $kunjungan->tgl_masuk,
                'icd_id' => $icd->id,
                'diagnosa' => $icd->nama,
                'keterangan' => $request->keterangan,
            ]);
            return response()->json('Success');
        } else {
            return response()->json('Error');
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
            $data = Diagnosa::where('kunjungan_id', $id)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('icd_id', function($row){
                    return $row->icd->kode;
                })
                ->addColumn('action', function($row){
                    $btn = '<div class="list-icons d-inline-flex">
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="list-icons-item text-danger me-10 deleteIcd" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                        <i class="fad fa-trash-alt fs-20"></i>
                                    </a>
                                </div>';
                    return $btn;
                })
                ->rawColumns(['action'])
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
        $data = Diagnosa::where('kunjungan_id', $id)->first();
        if ($data) {
            return response()->json(true);
        } else {
            return response()->json(false);
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
        Diagnosa::findOrFail($id)->delete();
        return response()->json('Success');
    }
}
