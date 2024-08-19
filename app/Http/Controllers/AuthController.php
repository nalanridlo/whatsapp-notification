<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Reminder;
use App\Models\Notification;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('layouts.welcome');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Jika login berhasil, redirect ke halaman dashboard atau halaman lain yang diinginkan
            return redirect()->route('dashboard');
        } else {
            // Jika login gagal, redirect kembali ke halaman login dengan pesan error
            notify()->error('Something went wrong');
            return redirect()->back()->withErrors(['Invalid username or password.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session and redirect to login page
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login'); // Redirect to the login or home page
    }
}
