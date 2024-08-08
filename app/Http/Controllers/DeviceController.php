<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\FonnteController;

class DeviceController extends Controller
{

    public function create()
    {
        return view('devices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:30',
            'device' => 'required|string|min:8|max:15',
            'autoread' => 'nullable|boolean',
            'personal' => 'nullable|boolean',
            'group' => 'nullable|boolean',
        ]);

        $response = Http::withHeaders([
            'Authorization' => 'fDN@8#NQbnj51e7Dz_cDBrLxVry4NUqyEq#u_mNetJwh!9AT', // Ganti TOKEN dengan token akun Fonnte Anda
        ])->post('https://api.fonnte.com/add-device', [
            'name' => $request->name,
            'device' => $request->device,
            'autoread' => $request->has('autoread') ? 'true' : 'false',
            'personal' => $request->has('personal') ? 'true' : 'false',
            'group' => $request->has('group') ? 'true' : 'false',
        ]);

        if ($response->successful()) {
            return redirect()->route('devices.create')->with('success', 'Device added successfully!');
        } else {
            return redirect()->route('devices.create')->with('error', 'Failed to add device: ' . $response->body());
        }
        
    }

    public function showDevices()
    {
        $fonnteController = new FonnteController();
        $devices = $fonnteController->getDevices(); // Mendapatkan respons API dari FonnteService

    if ($devices['status']) {
        // Jika respons berhasil, kirim data ke view
        return view('devices.index', ['devices' => $devices]);
    } else {
        // Jika ada masalah dengan API, tampilkan pesan kesalahan
        return view('devices.index', ['error' => 'Failed to retrieve devices.']);
    }
    }

    public function index()
    {
// Mengirim permintaan ke API Fonnte untuk mendapatkan semua perangkat
$response = Http::withHeaders([
    'Authorization' => 'fDN@8#NQbnj51e7Dz_cDBrLxVry4NUqyEq#u_mNetJwh!9AT', // Ganti TOKEN dengan token akun Fonnte Anda
])->post('https://api.fonnte.com/get-devices');

if ($response->successful()) {
    // Decode JSON response to array
    $devices = json_decode($response->body(), true);

    // Debug the structure of the $devices variable
    dd($devices); // or var_dump($devices); 

    // Pastikan bahwa devices adalah array sebelum mencoba mengaksesnya
    if (is_array($devices)) {
        return view('devices.index', compact('devices'));
    } else {
        return redirect()->route('devices.index')->with('error', 'Unexpected response format.');
    }
} else {
    return redirect()->route('devices.index')->with('error', 'Failed to fetch devices: ' . $response->body());
}
    }
}
