<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\FonnteService;

class FonnteController extends Controller
{
    public function sendMessage(Request $request)
    {
        $target = $request->input('target');
        $message = $request->input('message');
        $countryCode = $request->input('countryCode', '62'); // optional

        $response = Http::withHeaders([
            'Authorization' => 's4+Kg@Gg5gyu+--nioHV'
        ])->post('https://api.fonnte.com/send', [
            'target' => $target,
            'message' => $message,
            'countryCode' => $countryCode,
        ]);

        if ($response->successful()) {
            return response()->json(['status' => 'success', 'data' => $response->json()]);
        } else {
            return response()->json(['status' => 'error', 'message' => $response->body()], $response->status());
        }
    }

    public function getDevices()
    {
        $response = FonnteService::getDevices();

    // Cek apakah responsnya sukses
    if (isset($response['status']) && $response['status']) {
        $devices = $response['data']; // Ambil data devices dari response
        return view('devices.index', compact('devices'));
    } else {
        return view('devices.index', ['error' => 'Failed to retrieve devices.']);
    }
    }
}
