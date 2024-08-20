<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\FonnteController;
use App\Services\FonnteService;
use Illuminate\Support\Facades\Log;
use Exception;

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
            'autoread' => 'required|string|in:true,false', // Ubah menjadi string
            'personal' => 'required|string|in:true,false', // Ubah menjadi string
            'group' => 'required|string|in:true,false', // Ubah menjadi string
        ]);

        $response = Http::withHeaders([
            'Authorization' => 'fDN@8#NQbnj51e7Dz_cDBrLxVry4NUqyEq#u_mNetJwh!9AT', // Ganti TOKEN dengan token Anda
        ])->post('https://api.fonnte.com/add-device', [
            'name' => $request->name,
            'device' => $request->device,
            'autoread' => $request->input('autoread') === 'true' ? true : false,
            'personal' => $request->input('personal') === 'true' ? true : false,
            'group' => $request->input('group') === 'true' ? true : false,
        ]);

        if ($response->successful()) {
            return redirect()->route('devices.index')->with('success', 'Device added successfully!');
        } else {
            return back()->with('error', 'Failed to add device.');
        }
    }
    public function storeDevice(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|min:2|max:30',
            'device' => 'required|string|min:8|max:15',
        ]);

        $notificationController =  app(NotificationController::class);

        try {
            // Make the HTTP POST request
            $response = Http::withHeaders([
                'Authorization' => 'fDN@8#NQbnj51e7Dz_cDBrLxVry4NUqyEq#u_mNetJwh!9AT', // Replace with your token
            ])->post('https://api.fonnte.com/add-device', [
                'name' => $request->name,
                'device' => $request->device,
            ]);

            // Check if the response is successful
            if ($response->successful()) {
                $notificationController->store(new Request([
                    'title' => 'Device Added Successfully',
                    'message' => 'The device was added successfully.',
                    'status' => 'Success'
                ]));
                return redirect()->route('device')->with('success', 'Device added successfully!');
            } else {
                // Handle non-successful responses
                $notificationController->store(new Request([
                    'title' => 'Add Device Failed',
                    'message' => 'The device not added!.',
                    'status' => 'Failed'
                ]));
                Log::error('Failed to add device. Response: ' . $response->body());
                return back()->with('error', 'Failed to add device. Response: ' . $response->body());
            }
        } catch (Exception $e) {
            // Catch any exceptions that occur during the request
            $notificationController->store(new Request([
                'title' => 'Error',
                'message' => 'An error occurred while adding the device',
                'status' => 'Failed'
            ]));
            Log::error('Exception occurred while adding device: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while adding the device: ' . $e->getMessage());
        }
    }

    public function delete(Request $request, $device)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
            'token' => 'required|string'
        ]);

        $otp = $request->input('otp');
        $token = $request->input('token');

        Log::info("Attempting to delete device: $device with OTP: $otp");

        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->asForm()->post('https://api.fonnte.com/delete-device', [
            'otp' => $otp
        ]);

        Log::info('Delete Device Response: ' . $response->body());

        $responseData = $response->json();

        if ($response->successful() && isset($responseData['status']) && $responseData['status']) {
            return response()->json(['success' => true, 'message' => 'Device deleted successfully']);
        } else {
            $errorMessage = $responseData['reason'] ?? 'Unknown error';
            return response()->json(['success' => false, 'message' => "Failed to delete device: $errorMessage"]);
        }
    }

    public function requestOtp(Request $request, $device)
    {
        $token = $request->input('token');

        // Kirim permintaan OTP
        $response = Http::withHeaders([
            'Authorization' => $token
        ])->post('https://api.fonnte.com/delete-device', [
            'otp' => '' // Kosongkan OTP saat permintaan awal
        ]);

        if ($response->successful()) {
            return response()->json(['success' => true, 'message' => 'OTP requested successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to request OTP']);
        }
    }

    public function reconnect(Request $request, $device)
    {
        $token = $request->input('token'); // Mendapatkan token dari permintaan
        $whatsappNumber = $request->input('whatsapp'); // Nomor WhatsApp terkait

        // Kirim permintaan ke API untuk mendapatkan QR code
        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->asForm()->post('https://api.fonnte.com/qr', [
            'type' => 'qr',
            'whatsapp' => $whatsappNumber,
        ]);

        // Log respons dari API
        Log::info('Reconnect Device Response: ' . $response->body());

        // Cek apakah respons berhasil dan statusnya true
        $responseData = $response->json();
        if ($response->successful() && isset($responseData['status']) && $responseData['status']) {
            $qrUrl = $responseData['url'];
            return response()->json(['success' => true, 'qrUrl' => $qrUrl]);
        } else {
            $errorMessage = $responseData['reason'] ?? 'Unknown error';
            Log::error("Failed to reconnect device $device. Error: $errorMessage");
            return response()->json(['success' => false, 'message' => "Failed to reconnect device: $errorMessage"]);
        }
    }

    public function disconnect(Request $request, $device)
    {
        $token = $request->input('token'); // Mendapatkan token dari permintaan

        // Kirim permintaan ke API untuk memutuskan koneksi perangkat
        $response = Http::withHeaders([
            'Authorization' => $token, // Gunakan token dari permintaan
        ])->post('https://api.fonnte.com/disconnect');

        // Log respons dari API
        Log::info('Disconnect Device Response: ' . $response->body());

        // Cek apakah respons berhasil dan statusnya true
        $responseData = $response->json();
        if ($response->successful() && isset($responseData['status']) && $responseData['status']) {
            Log::info("Perangkat $device berhasil dihapus");
            return redirect()->route('device')->with('success');
        } else {
            $errorMessage = $responseData['reason'] ?? 'Kesalahan tidak diketahui';
            Log::error("Gagal menghapus perangkat $device. Error: $errorMessage");
            return response()->json(['success' => false, 'message' => $errorMessage]);
        }
    }

    public function index()
    {
        // Ganti 'YOUR_TOKEN' dengan token akun yang sebenarnya
        $token = 'fDN@8#NQbnj51e7Dz_cDBrLxVry4NUqyEq#u_mNetJwh!9AT';

        // Memanggil API untuk mendapatkan data devices
        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->post('https://api.fonnte.com/get-devices');

        // Cek apakah respons berhasil
        // // Cek apakah responsnya sukses
        if (isset($response['status']) && $response['status']) {
            $devices = $response['data']; // Ambil data devices dari response
            return view('devices.index', compact('devices'));
        } else {
            return view('devices.index', ['error' => 'Failed to retrieve devices.']);
        }
    }
}
