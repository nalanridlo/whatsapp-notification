<?php
namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use App\Jobs\SendReminder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ReminderController extends Controller
{
 
    public function dashboard()
    {
        $reminders = Reminder::all();
        return view('layouts.app', compact('reminders'));
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

        // Gabungkan tanggal dan waktu untuk mendapatkan Unix timestamp
        $reminderDateTime = Carbon::parse($reminder->reminder_date . ' ' . $reminder->reminder_time, config('app.timezone'))->setTimezone('UTC');
        $unixTimestamp = $reminderDateTime->timestamp;


        // Kirim permintaan ke Fonnte API untuk menjadwalkan pesan
        $this->sendScheduledMessage($reminder->phone_number, $reminder->message, $unixTimestamp);

        return redirect()->route('reminders.index')->with('success', 'Message scheduled successfully!');
    }

    private function sendScheduledMessage($phoneNumber, $message, $scheduleTimestamp)
    {
        $response = Http::withHeaders([
            'Authorization' => 's4+Kg@Gg5gyu+--nioHV', // Ganti TOKEN dengan token Anda
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

    public function index()
    {
        $reminders = Reminder::all();
        return view('reminders.index', compact('reminders'));
    }
}
