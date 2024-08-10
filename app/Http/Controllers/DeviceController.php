<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\FonnteController;

class DeviceController extends Controller
{
    public function index()
    {
        // Ganti 'YOUR_TOKEN' dengan token akun yang sebenarnya
        $token = 'fDN@8#NQbnj51e7Dz_cDBrLxVry4NUqyEq#u_mNetJwh!9AT';

        // Memanggil API untuk mendapatkan data devices
        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->post('https://api.fonnte.com/get-devices');

        // Cek apakah respons berhasil
        if ($response->successful()) {
            $devices = $response->json();
        } else {
            // Jika gagal, buat variabel devices sebagai array kosong
            $devices = [];
        }

        // Mengirim data devices ke view
        return view('devices.index', compact('devices'));
    }
   
    
}
