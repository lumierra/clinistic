<?php

namespace App\Http\Controllers\Admin\Rujukan;

use App\Http\Controllers\Controller;
use App\Models\AsalRujukan;
use App\Models\KategoriRujukan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RujukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        if ($request->ajax()) {
            $data = AsalRujukan::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('kategori_rujukan_id', function ($row){
                    $color = ['primary', 'success', 'info', 'warning', 'danger'];
                    return '<span class="btn btn-sm btn-'.$color[rand(0,4)].'">'.$row->kategoriRujukan->nama ?? ''.'</span>';
                })
                ->addColumn('action', function($row){
                    $btn = '<div class="list-icons d-inline-flex">
                                    <a href="javascript:void(0)"  data-id="'.$row->id.'" class="list-icons-item text-dark me-10 editProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                        <i class="fad fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="list-icons-item text-danger me-10 deleteProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                        <i class="fad fa-trash-alt"></i>
                                    </a>
                                </div>';
                    return $btn;
                })
                ->rawColumns(['action', 'kategori_rujukan_id'])
                ->make(true);
        }
        $kategori = KategoriRujukan::all();

        return view('admin.asalRujukan.index', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rujukan = AsalRujukan::updateOrCreate(
            ['id' => $request->product_id],
            [
                'kategori_rujukan_id' => $request->kategori,
                'nama' => $request->nama,
                'keterangan' => $request->keterangan
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
        $rujukan = AsalRujukan::findOrFail($id);
        return response()->json($rujukan);
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
        AsalRujukan::findOrFail($id)->delete();
        return response()->json(['success' => 'Berhasil dihapus.']);
    }
}
