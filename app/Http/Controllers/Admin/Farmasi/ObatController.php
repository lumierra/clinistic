<?php

namespace App\Http\Controllers\Admin\Farmasi;

use App\Http\Controllers\Controller;
use App\Models\Farmasi;
use App\Models\KategoriObat;
use App\Models\Obat;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        if ($request->ajax()) {
            $data = Obat::orderBy('kategori_obat_id', 'asc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('kategori_obat_id', function($row){
                    // $color = ['primary', 'success', 'danger', 'warning', 'info'];
                    ($row->kategoriObat->warna == '' ? '#f0f0f0' : $row->kategoriObat->warna);
                    return '<span class="btn btn-sm" style="background-color:'.($row->kategoriObat->warna == '' ? '#f0f0f0' : $row->kategoriObat->warna).'">'.$row->kategoriObat->nama_kategori ?? ''.'</span>';
                })
                ->editColumn('satuan_id', function($row){
                    return $row->satuan->nama_satuan ?? '';
                })
                ->editColumn('harga_modal', function($row){
                    return number_format($row->harga_modal, 0, ',', '.');
                })
                ->editColumn('harga_jual', function($row){
                    return number_format($row->harga_jual, 0, ',', '.');
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
        $satuan = Satuan::all();

        return view('admin.obat.index', compact('kategori', 'satuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $obat = Obat::all();
        return response()->json($obat);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $obat = Obat::updateOrCreate(
            ['id' => $request->product_id],
            [
                'kategori_obat_id' => $request->kategori,
                'satuan_id' => $request->satuan,
                'kode' => $request->kode,
                'nama' => $request->nama,
                'stok' => $request->stok,
                'harga_modal' => $request->harga_modal,
                'harga_jual' => $request->harga_jual,
                'persen' => $request->persen,
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
    public function show(Request $request, $id)
    {
        $obat = Obat::find($request->obat);
        if ($obat->stok < $request->jumlah) {
            return response()->json(0);
        } else {
            return response()->json(1);
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
        $obat = Obat::findOrFail($id);
        return response()->json($obat);
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
        $obat = Obat::findOrFail($request->product_id);
        $obat->update([
            'stok' => $obat->stok + $request->tambah_stok,
        ]);

        return response()->json('Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $farmasi = Farmasi::where('obat_id', $id)->orWhere('obat_pengganti_id', $id)->first();
        if ($farmasi){
            return response()->json(['status' => 201, 'message' => 'Obat tidak bisa dihapus karena sudah digunakan.']);
        } else {
            $obat = Obat::findOrFail($id);
            $obat->delete();
            return response()->json(['status' => 202, 'message' => 'Berhasil']);
        }
    }
}
