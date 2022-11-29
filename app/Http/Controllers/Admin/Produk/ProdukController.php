<?php

namespace App\Http\Controllers\Admin\Produk;

use App\Http\Controllers\Controller;
use App\Models\DetailTindakan;
use App\Models\KategoriProduk;
use App\Models\Poliklinik;
use App\Models\Produk;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        if ($request->ajax()) {
            $data = Produk::orderBy('kategori_produk_id', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kategori', function($row){
                    return $row->kategoriproduk->nama;
                })
                ->editColumn('harga', function($row){
                    return 'Rp. '.number_format($row->harga, 0, ',', '.');
                })
                ->editColumn('harga_klinik', function($row){
                    return 'Rp. '.number_format($row->harga_klinik, 0, ',', '.');
                })
                ->editColumn('harga_dokter', function($row){
                    return 'Rp. '.number_format($row->harga_dokter, 0, ',', '.');
                })
                ->editColumn('harga_perawat', function($row){
                    return 'Rp. '.number_format($row->harga_perawat, 0, ',', '.');
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
                    // if ($row->kategori_produk_id == 1){
                    //     $btn = '<div class="list-icons d-inline-flex">
                    //                 <a href="javascript:void(0)"  data-id="'.$row->id.'" class="list-icons-item text-dark me-10 editProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                    //                     <i class="fad fa-edit"></i>
                    //                 </a>
                    //                 <a href="javascript:void(0)" data-id="'.$row->id.'" class="list-icons-item text-danger me-10 deleteProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                    //                     <i class="fad fa-trash-alt"></i>
                    //                 </a>
                    //             </div>';
                    // } else {
                    //     $btn = '<div class="list-icons d-inline-flex">
                    //                 <a href="javascript:void(0)"  data-id="'.$row->id.'" class="list-icons-item text-dark me-10 addProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Sub">
                    //                     <i class="fad fa-plus"></i>
                    //                 </a>
                    //                 <a href="javascript:void(0)"  data-id="'.$row->id.'" class="list-icons-item text-dark me-10 editProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                    //                     <i class="fad fa-edit"></i>
                    //                 </a>
                    //                 <a href="javascript:void(0)" data-id="'.$row->id.'" class="list-icons-item text-danger me-10 deleteProduct" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                    //                     <i class="fad fa-trash-alt"></i>
                    //                 </a>
                    //             </div>';
                    // }

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $kategori = KategoriProduk::all();
        $poliklinik = Poliklinik::where('status', 'aktif')->get();
        $satuan = Satuan::all();

        return view('admin.produk.index', compact('kategori', 'poliklinik', 'satuan'));
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
        $produk = Produk::updateOrCreate(
            ['id' => $request->product_id],
            [
                'kategori_produk_id' => $request->kategori,
                'nama' => $request->nama,
                // 'harga' => (int)$request->harga,
                'poliklinik_id' => $request->unit,
                'harga_klinik' => (int)str_replace('.', '', $request->harga_klinik),
                'harga_dokter' => (int)str_replace('.', '', $request->harga_dokter),
                'harga_perawat' => (int)str_replace('.', '', $request->harga_perawat),
                'harga' => (int)str_replace('.', '', $request->harga_klinik) + (int)str_replace('.', '', $request->harga_dokter) + (int)str_replace('.', '', $request->harga_perawat),
                'nilai_rujukan' => $request->nilai_rujukan,
                'satuan_id' => $request->satuan,
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
        $produk = Produk::findOrFail($id);
        return response()->json($produk);
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
        // $produk = Produk::findOrFail($id);
        // $produk->delete();
        // return response()->json(['success' => 'Berhasil dihapus.']);
        $cekProduk = DetailTindakan::where('produk_id', $id)->first();
        if ($cekProduk) {
            return response()->json(['status' => 201, 'error' => 'Produk tidak dapat dihapus karena sudah digunakan.']);
        } else {
            $produk = Produk::findOrFail($id);
            $produk->delete();
            return response()->json(['status' => 200, 'success' => 'Berhasil dihapus.']);
        }
    }
}
