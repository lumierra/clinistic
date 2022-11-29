<?php

namespace App\Http\Controllers\Admin\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use App\Models\MenuUser;
use App\Models\Role;
use App\Models\Unit;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Submenu;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class PenggunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        if ($request->ajax()) {
            $data = User::where('username', '!=', 'aji')->orderBy('role_id')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function ($row){
                    // $result = implode(', ', $row->roles()->get()->pluck('name')->toArray());
                    $result = $row->role->name;
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
                ->rawColumns(['action', 'role'])
                ->make(true);
        }

        $roles = Role::where('name', '<>', 'spesial')->get();
        $submenu = Submenu::where('status', 'aktif')->orderBy('menu_id')->get();

        return view('admin.pengguna.index', compact('roles', 'submenu'));
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

        // dd($request->all());
        if ($request->status == 'create'){
            $user = User::updateOrCreate(
                ['id' => $request->product_id],
                [
                    'username' => $request->username,
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make('12345'),
                    'role_id' => $request->role,
                    'phone' => $request->phone,
                    'cekadmin' => $request->cekadmin,
                ]
            );
            if ($request->cekadmin == '1'){
                $submenu = Submenu::where('status', 'aktif')->get();
                foreach ($submenu as $key => $value) {
                    $menuuser = MenuUser::create([
                        'user_id' => $user->id,
                        'menu_id' => $value->menu->id,
                        'submenu_id' => $value->id,
                    ]);
                }
            } else {
                foreach ($request->submenu as $item){
                    $submenu = Submenu::find($item);
                    $menuuser = MenuUser::create([
                        'user_id' => $user->id,
                        'menu_id' => $submenu->menu->id,
                        'submenu_id' => $item,
                    ]);
                }
            }
        } else {
            $user = User::updateOrCreate(
                ['id' => $request->product_id],
                [
                    'username' => $request->username,
                    'name' => $request->name,
                    'email' => $request->email,
                    'role_id' => $request->role,
                    'phone' => $request->phone,
                    'cekadmin' => $request->cekadmin,
                ]
            );
            $menuuser = MenuUser::where('user_id', $user->id)->get();
            foreach ($menuuser as $key => $value) {
                $value->delete();
            }
            if ($request->cekadmin == '1'){
                $submenu = Submenu::where('status', 'aktif')->get();
                foreach ($submenu as $key => $value) {
                    $menuuser = MenuUser::create([
                        'user_id' => $user->id,
                        'menu_id' => $value->menu->id,
                        'submenu_id' => $value->id,
                    ]);
                }
            } else {
                foreach ($request->submenu as $item){
                    $submenu = Submenu::find($item);
                    $menuuser = MenuUser::create([
                        'user_id' => $user->id,
                        'menu_id' => $submenu->menu->id,
                        'submenu_id' => $item,
                    ]);
                }
            }
        }

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
        $user = User::find($id)->delete();
        $role = RoleUser::where('user_id', $id)->delete();
        return response()->json(['success'=>'Data Berhasil Di Hapus']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->with('menuuser')->first();
        return response()->json($user);
        // $role = implode(', ', $user->roles()->get()->pluck('id')->toArray());
        // return response()->json(['user' => $user, 'role' => $role]);
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
        $user = User::findOrFail($id);
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        Session::flush();
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
        $cek = Kunjungan::where('input_user_id', $id)->orWhere('update_user_id', $id)->first();
        if ($cek){
            return response()->json(
                [
                    'status' => 201,
                    'error' => 'Data tidak bisa dihapus karena sudah digunakan.'
                ]);
        } else {
            $user = User::find($id)->delete();
            return response()->json(
                [
                    'status' => 200,
                    'success' => 'Data Berhasil Dihapus'
                ]);
        }
    }
}
