<?php
namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use App\Jobs\SendReminder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ReminderController extends Controller
{

    public function create()
    {
        return view('reminders.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'phone_number' => 'required|string',
            'message' => 'required|string',
            'reminder_date' => 'required|date',
            'reminder_time' => 'required|date_format:H:i',
        ]);

        // Simpan data ke database
        $reminder = Reminder::create([
            'phone_number' => $request->phone_number,
            'message' => $request->message,
            'reminder_date' => $request->reminder_date,
            'reminder_time' => $request->reminder_time,
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
