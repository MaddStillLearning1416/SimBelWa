<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'nim'      => 'required',
            'password' => 'required'
        ]);

        // Gunakan guard('student') karena kita tidak lagi memakai tabel users
        if (Auth::guard('student')->attempt(['nim' => $request->nim, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard'); 
        }

        return back()->withErrors([
            'nim' => 'NIM atau Password yang Anda masukkan salah.',
        ])->onlyInput('nim');
    }
}