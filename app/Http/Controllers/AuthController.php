<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{
    public function index ()
    {
        return view('login');
    }
    public function auth (LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {

        $request->session()->regenerate();

        return redirect()->route('dashboard')->with('succes', 'selamat datang,' .Auth::user()->name);
        }
        return back()->withError([
            'email'=>'email atau password tidak valid'
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('succes', 'anda telah keluar aplikasi');

    }
}
