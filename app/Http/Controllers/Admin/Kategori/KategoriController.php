<?php

namespace App\Http\Controllers\Admin\Kategori;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        if ($request->ajax()) {
            $data = Kategori::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('nama_kategori', function($row){
                    $warna = ['primary', 'success', 'info', 'warning', 'danger', 'dark', 'secondary'];
                    return '<span class="badge badge-'.$warna[rand(0,4)].'">'.$row->nama_kategori.'</span>';
                })
                ->addColumn('action', function($row){
                    $btn = '';
                    $btn = $btn.' <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn-sm btn btn-primary btn-rounded editProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fa fa-user-edit"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn-sm btn btn-danger btn-rounded deleteProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="fa fa-user-times"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action', 'nama_kategori'])
                ->make(true);
        }

        return view('admin.kategori.index');
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
        $kategori = Kategori::updateOrCreate(
            ['id' => $request->product_id],
            [
                'nama_kategori' => $request->nama,
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
        Kategori::findOrFail($id)->delete();
        return response()->json('Success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return response()->json($kategori);
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
