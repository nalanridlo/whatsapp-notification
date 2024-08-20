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
}
