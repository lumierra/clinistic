<?php

namespace App\Http\Controllers\Admin\Asuransi;

use App\Http\Controllers\Controller;
use App\Models\Asuransi;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AsuransiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        if ($request->ajax()) {
            $data = Asuransi::orderBy('id', 'asc')->get();
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

        return view('admin.asuransi.index');
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
        $asuransi = Asuransi::updateOrCreate(
            ['id' => $request->product_id],
            [
                'nama' => $request->nama,
                'keterangan' => $request->keterangan,
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
        $asuransi = Asuransi::findOrFail($id);
        return response()->json($asuransi);
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
        $cek = Kunjungan::where('asuransi_id', $id)->count();
        if ($cek > 0) {
            return response()->json(['status'=>201,'error' => 'Data tidak bisa dihapus karena sudah digunakan.']);
        } else {
            Asuransi::findOrFail($id)->delete();
            return response()->json(['status'=>200,'success' => 'Berhasil dihapus.']);
        }
    }
}
