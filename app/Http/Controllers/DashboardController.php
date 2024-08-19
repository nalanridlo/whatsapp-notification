<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; // Add this line
use App\Models\Reminder;
use App\Models\Notification;
use Carbon\Carbon; // Add this line
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data devices
        if (Auth::check()) {
            $token = 'fDN@8#NQbnj51e7Dz_cDBrLxVry4NUqyEq#u_mNetJwh!9AT';
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->post('https://api.fonnte.com/get-devices');

            $devices = [];
            if (isset($response['status']) && $response['status']) {
                $devices = $response['data'] ?? [];
            }

            // Ambil data reminders/users
            $reminders = Reminder::all();

            // Ambil data notifikasi
            $notifications = Notification::latest()->get();

            // Kirim kedua data ke view
            return view('components.dashboard', compact('devices', 'reminders', 'notifications'));
        } else {
            notify()->error('You do not have access, Please Login First');
            return redirect()->back();
        }
    }

    public function getDevice()
    {
        // get data devices
        $token = 'fDN@8#NQbnj51e7Dz_cDBrLxVry4NUqyEq#u_mNetJwh!9AT';
        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->post('https://api.fonnte.com/get-devices');

        $devices = [];
        if (isset($response['status']) && $response['status']) {
            $devices = $response['data'] ?? [];
        }

        return view('components.device', [
            'devices' => $devices,
        ]);
    }

    public function getUsers(Request $request)
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
            'reminders' => $reminders, // Mengirim data reminders ke view
        ]);
    }

    // public function storeUsers(Request $request)
    // {
    //     $request->validate([
    //         'nama' => 'required|string',
    //         'phone_number' => 'required|string',
    //         'tanggalLahir' => 'required|date',
    //         'expire_date' => 'required|date',
    //     ]);

    //     $expireDate = Carbon::parse($request->expire_date);
    //     $reminderDate = $expireDate->copy()->subYear();

    //     $reminder = Reminder::create([
    //         'nama' => $request->nama,
    //         'phone_number' => $request->phone_number,
    //         'tanggalLahir' => $request->tanggalLahir,
    //         'expire_date' => $expireDate,
    //         'reminder_date' => $reminderDate,
    //         'message' => $request->input('message', 'Peringatan: Anda akan memasuki tahun keempat. Harap perbarui data Anda.'),
    //     ]);

    //     Notification::create([
    //         'title' => 'Insert Data',
    //         'message' => 'User data inserted successfully!',
    //         'status' => 'Success'
    //     ]);

    //     // Jadwalkan pesan untuk empat tahun ke depan
    //     $this->scheduleReminders($reminder);

    //     return redirect()->route('users')->with('success', 'Reminder created successfully!');
    // }

    // private function scheduleReminders(Reminder $reminder)
    // {
    //     $expireDate = Carbon::parse($reminder->expire_date);
    //     $reminderDates = [
    //         $reminder->reminder_date,          // 1 tahun sebelum expire (sudah diset di storeUsers)
    //         $expireDate->copy()->subMonths(6), // 6 bulan sebelum expire
    //         $expireDate->copy()->subMonths(3), // 3 bulan sebelum expire
    //         $expireDate->copy()->subDays(3),   // 3 hari sebelum expire
    //         $expireDate->copy()->subDays(2),   // 2 hari sebelum expire
    //         $expireDate->copy()->subDay(),     // 1 hari sebelum expire
    //         $expireDate,                       // pada hari expire
    //     ];

    //     foreach ($reminderDates as $date) {
    //         if ($date->isFuture()) {
    //             $message = $this->generateMessage($reminder, $date);
    //             $response = $this->sendScheduledMessage($reminder->phone_number, $message, $date->timestamp);

    //             Log::info('Reminder scheduled', [
    //                 'user' => $reminder->nama,
    //                 'phone' => $reminder->phone_number,
    //                 'date' => $date->format('Y-m-d H:i:s'),
    //                 'message' => $message,
    //                 'response' => $response
    //             ]);
    //         }
    //     }
    // }

    // private function generateMessage(Reminder $reminder, Carbon $date)
    // {
    //     $expireDate = Carbon::parse($reminder->expire_date);
    //     $diffInDays = $date->diffInDays($expireDate);
    //     $diffInMonths = $date->diffInMonths($expireDate);

    //     if ($diffInDays == 0) {
    //         return "Hari ini adalah batas akhir masa berlaku data Anda. Harap segera perbarui data Anda.";
    //     } elseif ($diffInDays == 1) {
    //         return "Besok adalah batas akhir masa berlaku data Anda. Harap segera perbarui data Anda.";
    //     } elseif ($diffInDays == 2) {
    //         return "2 hari lagi adalah batas akhir masa berlaku data Anda. Harap segera perbarui data Anda.";
    //     } elseif ($diffInDays == 3) {
    //         return "3 hari lagi adalah batas akhir masa berlaku data Anda. Harap segera perbarui data Anda.";
    //     } elseif ($diffInMonths == 3) {
    //         return "3 bulan lagi adalah batas akhir masa berlaku data Anda. Mohon persiapkan pembaruan data Anda.";
    //     } elseif ($diffInMonths == 6) {
    //         return "6 bulan lagi adalah batas akhir masa berlaku data Anda. Mohon perhatikan untuk memperbarui data Anda tepat waktu.";
    //     } elseif ($diffInDays == 365) {
    //         return "1 tahun lagi adalah batas akhir masa berlaku data Anda. Mohon ingat untuk memperbarui data Anda tahun depan.";
    //     } else {
    //         return "Peringatan: Masa berlaku data Anda akan berakhir pada " . $expireDate->format('d F Y') . ". Harap perbarui data Anda sebelum tanggal tersebut.";
    //     }
    // }

    // private function sendScheduledMessage($phone_number, $message, $scheduleTimestamp)
    // {
    //     $formattedPhone = $this->formatPhoneNumber($phone_number);

    //     $curl = curl_init();

    //     $postFields = [
    //         'target' => $formattedPhone,
    //         'message' => $message,
    //         'schedule' => $scheduleTimestamp,
    //         'countryCode' => '62',
    //     ];

    //     curl_setopt_array($curl, [
    //         CURLOPT_URL => 'https://api.fonnte.com/send',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'POST',
    //         CURLOPT_POSTFIELDS => $postFields,
    //         CURLOPT_HTTPHEADER => [
    //             'Authorization: Br!aX1vJRVCe8DAKmAs8' // Ganti dengan token Anda yang sebenarnya
    //         ],
    //     ]);

    //     $response = curl_exec($curl);
    //     $error = null;

    //     if (curl_errno($curl)) {
    //         $error = curl_error($curl);
    //     }

    //     curl_close($curl);

    //     if ($error) {
    //         Log::error('Failed to schedule message', [
    //             'phone' => $formattedPhone,
    //             'schedule' => date('Y-m-d H:i:s', $scheduleTimestamp),
    //             'error' => $error,
    //             'postFields' => $postFields
    //         ]);
    //     } else {
    //         Log::info('Message scheduled successfully', [
    //             'phone' => $formattedPhone,
    //             'schedule' => date('Y-m-d H:i:s', $scheduleTimestamp),
    //             'response' => $response,
    //             'postFields' => $postFields
    //         ]);
    //     }

    //     return $response;
    // }

    // private function formatPhoneNumber($phone_number)
    // {
    //     $number = preg_replace('/[^0-9]/', '', $phone_number);
    //     if (substr($number, 0, 1) === '0') {
    //         $number = '62' . substr($number, 1);
    //     }
    //     if (substr($number, 0, 2) !== '62') {
    //         $number = '62' . $number;
    //     }
    //     return $number;
    // }

    // public function delete(Request $request, $device)
    // {
    //     $request->validate([
    //         'otp' => 'required|string|size:6',
    //         'token' => 'required|string'
    //     ]);

    //     $otp = $request->input('otp');
    //     $token = $request->input('token');

    //     Log::info("Attempting to delete device: $device with OTP: $otp");

    //     $response = Http::withHeaders([
    //         'Authorization' => $token,
    //     ])->asForm()->post('https://api.fonnte.com/delete-device', [
    //         'otp' => $otp
    //     ]);

    //     Log::info('Delete Device Response: ' . $response->body());

    //     $responseData = $response->json();

    //     if ($response->successful() && isset($responseData['status']) && $responseData['status']) {
    //         Log::info("Device $device deleted successfully");
    //         return redirect()->route('device')->with('success', 'Device deleted successfully!');
    //     } else {
    //         $errorMessage = $responseData['reason'] ?? 'Unknown error';
    //         Log::error("Failed to delete device $device. Error: $errorMessage");
    //         return redirect()->route('device')->with('error', "Failed to delete device: $errorMessage");
    //     }
    // }

    // public function requestOtp(Request $request, $device)
    // {
    //     $token = $request->input('token');

    //     // Kirim permintaan OTP
    //     $response = Http::withHeaders([
    //         'Authorization' => $token
    //     ])->post('https://api.fonnte.com/delete-device', [
    //         'otp' => '' // Kosongkan OTP saat permintaan awal
    //     ]);

    //     if ($response->successful()) {
    //         // Redirect ke halaman input OTP
    //         return view('device', compact('device', 'token'));
    //     } else {
    //         return back()->with('error', 'Failed to request OTP.');
    //     }
    // }

    // public function reconnect(Request $request, $device)
    // {
    //     $token = $request->input('token'); // Mendapatkan token dari permintaan
    //     $whatsappNumber = $request->input('whatsapp'); // Nomor WhatsApp terkait

    //     // Kirim permintaan ke API untuk mendapatkan QR code
    //     $response = Http::withHeaders([
    //         'Authorization' => $token,
    //     ])->asForm()->post('https://api.fonnte.com/qr', [
    //         'type' => 'qr',
    //         'whatsapp' => $whatsappNumber,
    //     ]);

    //     // Log respons dari API
    //     Log::info('Reconnect Device Response: ' . $response->body());

    //     // Cek apakah respons berhasil dan statusnya true
    //     $responseData = $response->json();
    //     if ($response->successful() && isset($responseData['status']) && $responseData['status']) {
    //         $qrUrl = $responseData['url'];
    //         return view('devices.reconnect', compact('qrUrl', 'device'));
    //     } else {
    //         $errorMessage = $responseData['reason'] ?? 'Unknown error';
    //         Log::error("Failed to reconnect device $device. Error: $errorMessage");
    //         return redirect()->route('devices.index')->with('error', "Failed to reconnect device: $errorMessage");
    //     }
    // }

    // public function disconnect(Request $request, $device)
    // {
    //     $token = $request->input('token');

    //     // Kirim permintaan ke API untuk memutuskan koneksi perangkat
    //     $response = Http::withHeaders([
    //         'Authorization' => $token,
    //     ])->post('https://api.fonnte.com/disconnect');

    //     // Log respons dari API
    //     Log::info('Disconnect Device Response: ' . $response->body());

    //     // Cek apakah respons berhasil dan statusnya true
    //     $responseData = $response->json();
    //     if ($response->successful() && isset($responseData['status']) && $responseData['status']) {
    //         Log::info("Device $device disconnected successfully");
    //         return redirect()->route('device')->with('success', 'Device disconnected successfully!');
    //     } else {
    //         $errorMessage = $responseData['detail'] ?? 'Unknown error';
    //         Log::error("Failed to disconnect device $device. Error: $errorMessage");
    //         return redirect()->route('device')->with('error', "Failed to disconnect device: $errorMessage");
    //     }
    // }

    // public function storeDevice(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|min:2|max:30',
    //         'device' => 'required|string|min:8|max:15',

    //     ]);

    //     $response = Http::withHeaders([
    //         'Authorization' => 'fDN@8#NQbnj51e7Dz_cDBrLxVry4NUqyEq#u_mNetJwh!9AT', // Ganti TOKEN dengan token Anda
    //     ])->post('https://api.fonnte.com/add-device', [
    //         'name' => $request->name,
    //         'device' => $request->device,

    //     ]);

    //     if ($response->successful()) {
    //         return redirect()->route('device')->with('success', 'Device added successfully!');
    //     } else {
    //         return back()->with('error', 'Failed to add device.');
    //     }
    // }
}
