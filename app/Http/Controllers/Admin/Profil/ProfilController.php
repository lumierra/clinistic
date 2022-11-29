<?php

namespace App\Http\Controllers\Admin\Profil;

use App\Http\Controllers\Controller;
use App\Models\Gender;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profil = Auth::user();
        $gender = Gender::all();
        return view('admin.profil.index', compact('profil', 'gender'));
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
        $user = User::findOrFail($request->user);
        if ($request->status == 'identitas'){
            if ($request->hasFile('photo')){
                if ($request->file('photo')->isValid()){
                    if ($user->foto != null){
                        $image_path = public_path().'/'.$user->foto;
                        unlink($image_path);
                    }
                    $time = Carbon::now()->timestamp;
                    $path = $request->file('photo')->storeAs('user',  'user-'.$user->username.$time.'.webp', 'public');

                    $user->update([
                        'name' => $request->nama,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'alamat' => $request->alamat,
                        'gender_id' => $request->gender,
                        'tempat_lahir' => $request->tempat_lahir,
                        'tgl_lahir' => $request->tanggal_lahir,
                        'foto' => 'storage/'.$path,
                    ]);
                }
            } else {
                $user->update([
                    'name' => $request->nama,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'alamat' => $request->alamat,
                    'gender_id' => $request->gender,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tgl_lahir' => $request->tanggal_lahir,
                ]);
            }

        } else if ($request->status == 'medsos'){
            $user->update([
                'instagram' => $request->instagram,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
            ]);
        } else if ($request->status == 'password'){
            $user->update([
                'password' => Hash::make($request->password_baru),
            ]);
        }

        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profil = User::findOrFail($id);
        return view('admin.profil.right', compact('profil'));
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
        dd($request->all());
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
