<?php

namespace App\Http\Controllers\Admin\Poliklinik;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use App\Models\Poliklinik;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PoliklinikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        if ($request->ajax()) {
            $data = Poliklinik::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function($row){
                    if ($row->status == 'aktif'){
                        return '<span class="badge badge-success">Aktif <i class="fal fa-check-circle"></i></span>';
                    } else {
                        return '<span class="badge badge-danger">Tidak Aktif <i class="fal fa-times-circle"></i></span>';
                    }
                })
                ->addColumn('action', function($row){
                    $btn = '<div class="list-icons d-inline-flex">
                                    <a href="javascript:void(0)"  data-id="'.$row->id.'" class="list-icons-item text-dark me-10 editProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                        <i class="fad fa-edit fs-20"></i>
                                    </a>
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="list-icons-item text-danger me-10 deleteProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                        <i class="fad fa-trash-alt fs-20"></i>
                                    </a>
                                </div>';
                    return $btn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.poliklinik.index');
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
        $poli = Poliklinik::updateOrCreate(
            ['id' => $request->product_id],
            [
                'nama' => $request->nama,
                'keterangan' => $request->keterangan,
                'status' => $request->status,
                'nomor_antrian' => $request->antrian,
            ]
        );
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
        $poli = Poliklinik::findOrFail($id);
        return response()->json($poli);
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
        $cek = Kunjungan::where('poliklinik_id', $id)->first();
        if ($cek){
            return response()->json(
                [
                    'status' => 201,
                    'error' => 'Data tidak bisa dihapus karena sudah digunakan.'
                ]);
        } else {
            Poliklinik::findOrFail($id)->delete();
            return response()->json(
                [
                    'status' => 200,
                    'success' => 'Data Berhasil Dihapus'
                ]);
        }
    }
}
