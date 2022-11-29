<?php

namespace App\Http\Controllers\Admin\Jenis;

use App\Http\Controllers\Controller;
use App\Models\JenisWaste;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JenisWasteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        if ($request->ajax()) {
            $data = JenisWaste::all();
            return DataTables::of($data)
                ->addIndexColumn()
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
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.jenisWaste.index');
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
        $jenis = JenisWaste::updateOrCreate(
            ['id' => $request->product_id],
            [
                'nama' => $request->nama,
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
        $jenis = JenisWaste::findOrFail($id);
        return response()->json($jenis);
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
        $jenis = JenisWaste::findOrFail($id);
        $jenis->delete();
        return response()->json(['success' => 'Berhasil dihapus.']);
    }
}
