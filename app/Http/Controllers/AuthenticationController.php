<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout', 'changePassword', 'storePassword');
    }

    public function storeLogin(LoginRequest $request){
        if (Auth::attempt([
            "email" => $request->email,
            "password" => $request->password,
        ])){
            return redirect()->to(route("dashboard"));
        }else {
            return redirect()->to(route("auth.login"))->with("gagal", "Periksa Kembali Username / Password Anda");
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->to(route("auth.login"))->with("sukses", "Logout Berhasil");
    }    
}
