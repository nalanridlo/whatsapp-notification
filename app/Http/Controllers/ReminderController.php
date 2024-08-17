<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use App\Jobs\SendReminder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;

class ReminderController extends Controller
{

    public function dashboard()
    {
        $reminders = Reminder::all();
        return view('dashboard', compact('reminders'));
    }

    public function create()
    {
        return view('reminders.create');
    }

    public function store(Request $request)
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

        return redirect()->route('dashboard')->with('success', 'Reminder created successfully!');
    }

    private function sendScheduledMessage($phoneNumber, $message, $scheduleTimestamp)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Br!aX1vJRVCe8DAKmAs8', // Ganti TOKEN dengan token Anda
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
    public function delete(Reminder $reminder)
    {
        try {
            $reminder->delete();
            return response()->json(['success' => true, 'message' => 'Reminder deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete reminder'], 500);
        }
    }

    public function search(Request $request)
    {
        Log::info('Search request received: ' . $request->get('search'));
    
        try {
            $search = $request->get('search');
    
            // Build query with optional search filter
            $query = Reminder::query()
                ->when($search, function ($query, $search) {
                    $query->where('nama', 'like', '%' . $search . '%')
                          ->orWhere('phone_number', 'like', '%' . $search . '%');
                })
                ->orderBy('created_at', 'desc'); // Optional: Sort by created_at or another column
    
            $reminders = $query->get();
    
            return response()->json($reminders);
        } catch (\Exception $e) {
            Log::error('Search error: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while processing your request'], 500);
        }
    }
    

    public function index()
    {
        $reminders = Reminder::all();
        return view('reminders.index', compact('reminders'));
    }
}
