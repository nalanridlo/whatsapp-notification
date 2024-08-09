<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if ($username === 'admin' && $password === 'admin') {
            // Jika login berhasil, redirect ke halaman dashboard atau halaman lain yang diinginkan
            return redirect()->route('dashboard');
        } else {
            // Jika login gagal, redirect kembali ke halaman login dengan pesan error
            return redirect()->back()->withErrors(['Invalid username or password.']);
        }
    }

}
