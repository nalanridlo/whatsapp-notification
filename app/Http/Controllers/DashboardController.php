<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; // Add this line
use App\Models\Reminder;
use App\Models\Notification;
use Carbon\Carbon; // Add this line

use function Laravel\Prompts\search;

class DashboardController extends Controller
{

    public function storeUsers(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'phone_number' => 'required|string',
            'tanggalLahir' => 'required|date',
            'expire_date' => 'required|date',
        ]);

        $expireDate = Carbon::parse($request->expire_date);
        $reminderDate = $expireDate->copy()->subYears(4);

        $reminder = Reminder::create([
            'nama' => $request->nama,
            'phone_number' => $request->phone_number,
            'tanggalLahir' => $request->tanggalLahir,
            'reminder_date' => $reminderDate,
            'expire_date' => $expireDate,
            'message' => $request->input('message', 'Peringatan: Anda akan memasuki tahun keempat. Harap perbarui data Anda.'),
        ]);

        Notification::create([
            'title' => 'Insert Data',
            'message' => 'User data inserted successfully!',
            'status' => 'Success'
        ]);

        // Jadwalkan pesan untuk empat tahun ke depan
        $this->scheduleAnnualReminders($reminder);

        return redirect()->route('users')->with('success', 'Reminder created successfully!');
    }

    private function scheduleAnnualReminders(Reminder $reminder)
    {
        $expireDate = Carbon::parse($reminder->expire_date);
        $currentDate = Carbon::parse($reminder->reminder_date);

        while ($currentDate->lte($expireDate)) {
            $scheduleTimestamp = $currentDate->copy()->setTimezone('UTC')->timestamp;
            $this->sendScheduledMessage($reminder->phone_number, $reminder->message, $scheduleTimestamp);

            $currentDate->addYear();
        }
    }

    private function sendScheduledMessage($phone_number, $message, $scheduleTimestamp)
    {
        // Format nomor telepon
        $formattedPhone = $this->formatPhoneNumber($phone_number);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $formattedPhone,
                'message' => $message,
                'schedule' => $scheduleTimestamp,
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Br!aX1vJRVCe8DAKmAs8' // Ganti dengan token Anda yang sebenarnya
            ),
        ));

        $response = curl_exec($curl);
        $error = null;

        if (curl_errno($curl)) {
            $error = curl_error($curl);
        }

        curl_close($curl);

        if ($error) {
            Log::error('Failed to schedule message', [
                'phone' => $formattedPhone,
                'schedule' => $scheduleTimestamp,
                'error' => $error
            ]);
        } else {
            Log::info('Message scheduled successfully', [
                'phone' => $formattedPhone,
                'schedule' => $scheduleTimestamp,
                'response' => $response
            ]);
        }

        return $response;
    }
    private function formatPhoneNumber($phone_number)
    {
        // Hapus semua karakter non-digit
        $number = preg_replace('/[^0-9]/', '', $phone_number);

        // Jika dimulai dengan '0', ganti dengan '62'
        if (substr($number, 0, 1) === '0') {
            $number = '62' . substr($number, 1);
        }

        // Jika belum dimulai dengan '62', tambahkan di depan
        if (substr($number, 0, 2) !== '62') {
            $number = '62' . $number;
        }

        return $number;
    }

    public function dashboard()
    {
        return view('components.dashboard', [
            'activePage' => 'dashboard',
        ]);
    }

    public function users(Request $request)
    {
        $search = $request->search;
        if ($search) {
            $reminders = Reminder::where('nama', 'like', "%$search%")
                ->orWhere('phone_number', 'like', "%$search%")
                ->get();
        } else {
            $reminders = Reminder::all();
        }
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
