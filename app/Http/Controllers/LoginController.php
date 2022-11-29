<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::where('username', $request->username)->first();
        if ($user){
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return response()->json([
                    'status' => true,
                    'message' => 'Success'
                ]);
            }
            return response()->json([
                'status' => false,
                'message' => 'Salah Password'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Username tidak terdaftar'
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
