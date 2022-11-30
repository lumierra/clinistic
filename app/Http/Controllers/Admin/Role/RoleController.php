<?php

namespace App\Http\Controllers\Admin\Role;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        if ($request->ajax()) {
            $data = Role::where('name', '<>', 'spesial')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('icon', function($row){
                    $result = $row->name;
                    if ($result == 'admin'){
                        return '<button class="waves-effect waves-light btn-sm btn btn-dark btn-rounded btn-social btn-bitbucket">
                                    <i class="fal fa-user-crown"></i> Admin
                                </button>';
                    } else if ($result == 'dokter'){
                        return '<button class="waves-effect waves-light btn-sm btn btn-info btn-rounded btn-social btn-bitbucket">
                                    <i class="fal fa-user-md"></i> Dokter
                                </button>';
                    } else if ($result == 'perawat'){
                        return '<button class="waves-effect waves-light btn-sm btn btn-info btn-rounded btn-social btn-bitbucket">
                                    <i class="fal fa-user-nurse"></i> Perawat
                                </button>';
                    } else if ($result == 'operator'){
                        return '<button class="waves-effect waves-light btn-sm btn btn-warning btn-rounded btn-social btn-bitbucket">
                                    <i class="fal fa-user-headset"></i> Operator
                                </button>';
                    } else if ($result == 'kasir'){
                        return '<button class="waves-effect waves-light btn-sm btn btn-warning btn-rounded btn-social btn-bitbucket">
                                    <i class="fal fa-user-chart"></i> Kasir
                                </button>';
                    } else if ($result == 'apoteker'){
                        return '<button class="waves-effect waves-light btn-sm btn btn-primary btn-rounded btn-social btn-bitbucket">
                                    <i class="fal fa-capsules"></i> Apoteker
                                </button>';
                    } else if ($result == 'operator lab'){
                        return '<button class="waves-effect waves-light btn-sm btn btn-success btn-rounded btn-social btn-bitbucket">
                                    <i class="fal fa-flask"></i> Operator Lab
                                </button>';
                    } else if ($result == 'operator rad'){
                        return '<button class="waves-effect waves-light btn-sm btn btn-danger btn-rounded btn-social btn-bitbucket">
                                    <i class="fal fa-x-ray"></i> Operator Rad
                                </button>';
                    }  else if ($result == 'beautician'){
                        return '<button class="waves-effect waves-light btn-sm btn btn-success btn-rounded btn-social btn-bitbucket">
                                    <i class="fal fa-x-ray"></i> Beautician
                                </button>';
                    } else {
                        return '<button class="waves-effect waves-light btn-sm btn btn-warning btn-rounded btn-social btn-bitbucket">
                                    <i class="fal fa-user-shield"></i> '.Str::title($result).'
                                </button>';
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
                ->rawColumns(['action', 'icon'])
                ->make(true);
        }

        return view('admin.role.index');
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
        $role = Role::updateOrCreate(
            ['id' => $request->product_id],
            ['name' => $request->nama]
        );

        return response()->json(['success'=>'Data Berhasil Di Simpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('role_id', $id)->first();
        if(!$user){
            Role::findOrFail($id)->delete();
            return response()->json('success');
        } else {
            return response()->json('Data tidak dapat dihapus');
        }
    }
}
