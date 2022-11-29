<?php

namespace App\Http\Controllers\Admin\Farmasi;

use App\Http\Controllers\Controller;
use App\Models\KategoriObat;
use App\Models\Obat;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DataObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        if ($request->ajax()) {
            $data = Obat::orderBy('kategori_obat_id', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('kategori_obat_id', function($row){
                    ($row->kategoriObat->warna == '' ? '#f0f0f0' : $row->kategoriObat->warna);
                    return '<span class="btn btn-sm" style="background-color:'.($row->kategoriObat->warna == '' ? '#f0f0f0' : $row->kategoriObat->warna).'">'.$row->kategoriObat->nama_kategori ?? ''.'</span>';
                })
                ->editColumn('satuan_id', function($row){
                    return $row->satuan->nama_satuan ?? '';
                })
                ->addColumn('action', function($row){
                    $btn = '<div class="list-icons d-inline-flex">
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="list-icons-item text-dark me-10 stokProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Stok">
                                        <i class="fad fa-plus"></i>
                                    </a>
                                    <a href="javascript:void(0)"  data-id="'.$row->id.'" class="list-icons-item text-dark me-10 editProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                        <i class="fad fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="list-icons-item text-danger me-10 deleteProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                        <i class="fad fa-trash-alt"></i>
                                    </a>
                                </div>';
                    return $btn;
                })
                ->rawColumns(['action', 'kategori_obat_id'])
                ->make(true);
        }

        $kategori = KategoriObat::all();

        return view('admin.farmasi.dataObat', compact('kategori'));
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
    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Obat::where('kategori_obat_id', $id)->orderBy('nama')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('kategori_obat_id', function($row){
                    ($row->kategoriObat->warna == '' ? '#f0f0f0' : $row->kategoriObat->warna);
                    return '<span class="btn btn-sm" style="background-color:'.($row->kategoriObat->warna == '' ? '#f0f0f0' : $row->kategoriObat->warna).'">'.$row->kategoriObat->nama_kategori ?? ''.'</span>';
                })
                ->editColumn('satuan_id', function($row){
                    return $row->satuan->nama_satuan ?? '';
                })
                ->addColumn('action', function($row){
                    $btn = '<div class="list-icons d-inline-flex">
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="list-icons-item text-dark me-10 stokProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Stok">
                                        <i class="fad fa-plus"></i>
                                    </a>
                                    <a href="javascript:void(0)"  data-id="'.$row->id.'" class="list-icons-item text-dark me-10 editProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                        <i class="fad fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="list-icons-item text-danger me-10 deleteProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                        <i class="fad fa-trash-alt"></i>
                                    </a>
                                </div>';
                    return $btn;
                })
                ->rawColumns(['action', 'kategori_obat_id'])
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
        //
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
