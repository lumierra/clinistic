<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuUser;
use App\Models\Submenu;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        if ($request->ajax()) {
            $data = Submenu::orderBy('menu_id', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('menu_id', function($row){
                    return $row->menu->nama;
                })
                ->editColumn('status', function($row){
                    if ($row->status == 'aktif'){
                        return '<span class="badge badge-success">Aktif</span>';
                    } else {
                        return '<span class="badge badge-danger">Tidak Aktif</span>';
                    }
                })
                ->editColumn('icon', function($row){
                    return '<i class="'.$row->icon.'"></i>';
                })
                ->addColumn('action', function($row){
                    $btn = '<div class="list-icons d-inline-flex">
                                    <a href="javascript:void(0)"  data-id="'.$row->id.'" class="list-icons-item text-dark me-10 editProductSubmenu" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                        <i class="fad fa-edit fs-20"></i>
                                    </a>
                                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="list-icons-item text-danger me-10 deleteProductSubmenu" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                        <i class="fad fa-trash-alt fs-20"></i>
                                    </a>
                                </div>';
                    return $btn;
                })
                ->rawColumns(['action', 'icon', 'status'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = Menu::where('status', 'aktif')->orderBy('urut', 'asc')->get();
        return response()->json($menu);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $submenu = Submenu::updateOrCreate(
            ['id' => $request->product_id],
            [
                'menu_id' => $request->menu,
                'nama' => $request->nama,
                'icon' => $request->icon,
                'url' => $request->url,
                'status' => $request->status,
                'urut' => $request->urut,
            ]
        );

        return response()->json(['success'=>'Data Berhasil Di Simpan']);
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
        $submenu = Submenu::findOrFail($id);
        return response()->json($submenu);
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
        $cek = MenuUser::where('submenu_id', $id)->first();
        if ($cek){
            return response()->json(['status' => 201,'message'=>'Data Tidak Dapat Di Hapus']);
        } else {
            $submenu = Submenu::findOrfail($id);
            $submenu->delete();
            return response()->json(['status' => 200,'message'=>'Data Berhasil Di Hapus']);
        }
    }
}
