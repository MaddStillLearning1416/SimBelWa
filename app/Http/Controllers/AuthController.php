<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function index()
    {
        return view('login'); // Pastikan nama file blade login Anda sesuai
    }

    // Memproses login
    public function login(Request $request)
    {
        $request->validate([
            'nim'      => 'required',
            'password' => 'required'
        ]);

        // === PERANGKAP DEBUGGING ===
        $student = \App\Models\Student::where('nim', $request->nim)->first();
        
        if (!$student) {
            dd("STOP! NIM " . $request->nim . " ternyata tidak ada di tabel students!");
        }
        
        if (!\Illuminate\Support\Facades\Hash::check($request->password, $student->password)) {
            dd("STOP! NIM ketemu, tapi Password-nya TIDAK COCOK dengan yang ada di database.");
        }
        // ============================

        // Jika lolos dari perangkap di atas, berarti NIM & Password sebenarnya BENAR.
        if (\Illuminate\Support\Facades\Auth::guard('student')->attempt(['nim' => $request->nim, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard'); 
        }

        // Jika sampai di sini, berarti masalahnya ada di Model atau Config
        dd("STOP! Password sudah benar, tapi Auth::attempt gagal. Pastikan Model Student sudah 'extends Authenticatable'!");
    }
    // Memproses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}