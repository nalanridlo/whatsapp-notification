<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; // Add this line
use App\Models\Reminder;
use App\Models\Notification;
use Carbon\Carbon; // Add this line
class DashboardController extends Controller
{

    public function storeUsers(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string',
        'phone_number' => 'required|string',
        'tanggalLahir' => 'required|date',
        'reminder_date' => 'required|date',
        'expire_date' => 'required|date',
        ]);

        // Simpan data ke database
        $reminder = Reminder::create([
            'nama' => $request->nama,
        'phone_number' => $request->phone_number,
        'tanggalLahir' => $request->tanggalLahir,
        'reminder_date' => $request->reminder_date,
        'expire_date' => $request->expire_date,
        'message' => $request->input('message', 'pesan ini merupakan peringatan bahwa anda akan expired date'),
        ]);
        
        Notification::create([
            'title' => 'Insert Data',
            'message' => 'User data inserted successfully!',
            'status' => 'Success'
        ]);

        // Gabungkan tanggal dan waktu untuk mendapatkan Unix timestamp
        $reminderDateTime = Carbon::parse($reminder->reminder_date . ' ' . $reminder->reminder_time, config('app.timezone'))->setTimezone('UTC');
        $unixTimestamp = $reminderDateTime->timestamp;


        // Kirim permintaan ke Fonnte API untuk menjadwalkan pesan
        $this->sendScheduledMessage($reminder->phone_number, $reminder->message, $unixTimestamp);

        return redirect()->route('users')->with('success', 'Reminder created successfully!');
    }

    private function sendScheduledMessage($phoneNumber, $message, $scheduleTimestamp)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Br!aX1vJRVCe8DAKmAs8', // Ganti TOKENDevice dengan token Anda
        ])->post('https://api.fonnte.com/send', [
            'target' => $phoneNumber,
            'message' => $message,
            'schedule' => $scheduleTimestamp,
            'countryCode' => '62', // Optional
        ]);

        if ($response->failed()) {
            // Tangani jika ada error
            throw new \Exception('Failed to schedule message: ' . $response->body());
        }

        return $response->json();
    }

    public function dashboard()
    {
        return view('components.dashboard', [
            'activePage' => 'dashboard',
        ]);
    }

    public function users()
    {
        $reminders = Reminder::all(); // Mengambil semua data dari model Reminder

        return view('components.users', [
            'activePage' => 'users',
            'reminders' => $reminders, // Mengirim data reminders ke view
        ]);
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
            Log::info("Device $device deleted successfully");
            return redirect()->route('device')->with('success', 'Device deleted successfully!');
        } else {
            $errorMessage = $responseData['reason'] ?? 'Unknown error';
            Log::error("Failed to delete device $device. Error: $errorMessage");
            return redirect()->route('device')->with('error', "Failed to delete device: $errorMessage");
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
        // Redirect ke halaman input OTP
        return view('device', compact('device', 'token'));
    } else {
        return back()->with('error', 'Failed to request OTP.');
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
        return view('devices.reconnect', compact('qrUrl', 'device'));
    } else {
        $errorMessage = $responseData['reason'] ?? 'Unknown error';
        Log::error("Failed to reconnect device $device. Error: $errorMessage");
        return redirect()->route('devices.index')->with('error', "Failed to reconnect device: $errorMessage");
    }
}

    public function disconnect(Request $request, $device)
    {
        $token = $request->input('token');
        
        // Kirim permintaan ke API untuk memutuskan koneksi perangkat
        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->post('https://api.fonnte.com/disconnect');
    
        // Log respons dari API
        Log::info('Disconnect Device Response: ' . $response->body());
    
        // Cek apakah respons berhasil dan statusnya true
        $responseData = $response->json();
        if ($response->successful() && isset($responseData['status']) && $responseData['status']) {
            Log::info("Device $device disconnected successfully");
            return redirect()->route('device')->with('success', 'Device disconnected successfully!');
        } else {
            $errorMessage = $responseData['detail'] ?? 'Unknown error';
            Log::error("Failed to disconnect device $device. Error: $errorMessage");
            return redirect()->route('device')->with('error', "Failed to disconnect device: $errorMessage");
        }
    }

    public function storeDevice(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:30',
            'device' => 'required|string|min:8|max:15',
           
        ]);

        $response = Http::withHeaders([
            'Authorization' => 'fDN@8#NQbnj51e7Dz_cDBrLxVry4NUqyEq#u_mNetJwh!9AT', // Ganti TOKEN dengan token Anda
        ])->post('https://api.fonnte.com/add-device', [
            'name' => $request->name,
            'device' => $request->device,
            
        ]);

        if ($response->successful()) {
            return redirect()->route('device')->with('success', 'Device added successfully!');
        } else {
            return back()->with('error', 'Failed to add device.');
        }
    }

    public function device()
    {
         // Ambil data devices
    $token = 'fDN@8#NQbnj51e7Dz_cDBrLxVry4NUqyEq#u_mNetJwh!9AT';
    $response = Http::withHeaders([
        'Authorization' => $token,
    ])->post('https://api.fonnte.com/get-devices');

    $devices = [];
    if (isset($response['status']) && $response['status']) {
        $devices = $response['data'] ?? [];
    }

    return view('components.device', [
        'activePage' => 'device',
        'devices' => $devices,
    ]);
    }
    
    public function index()
    {
        // Ambil data devices
        $token = 'fDN@8#NQbnj51e7Dz_cDBrLxVry4NUqyEq#u_mNetJwh!9AT';
        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->post('https://api.fonnte.com/get-devices');

        $devices = [];
        if (isset($response['status']) && $response['status']) {
            $devices = $response['data'] ?? [];
        }

        // Ambil data reminders
        $reminders = Reminder::all();

         // Ambil data notifikasi
         $notifications = Notification::latest()->take(6)->get();

        // Kirim kedua data ke view
        return view('components.dashboard', compact('devices', 'reminders', 'notifications'));
    }
}
