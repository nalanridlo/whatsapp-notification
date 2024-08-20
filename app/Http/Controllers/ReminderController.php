<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Notification;

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

    public function storeUsers(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'phone_number' => 'required|string',
            'tanggalLahir' => 'required|date',
            'expire_date' => 'required|date',
        ]);

        $notificationController =  app(NotificationController::class);

        try {
            $expireDate = Carbon::parse($request->expire_date);
            $reminderDate = $expireDate->copy()->subYear();

            $reminder = Reminder::create([
                'nama' => $request->nama,
                'phone_number' => $request->phone_number,
                'tanggalLahir' => $request->tanggalLahir,
                'expire_date' => $expireDate,
                'reminder_date' => $reminderDate,
                'message' => $request->input('message', 'Peringatan: Anda akan memasuki tahun keempat. Harap perbarui data Anda.'),
            ]);

            // Jadwalkan pesan untuk empat tahun ke depan
            $this->scheduleReminders($reminder);

            // Notifikasi
            $notificationController->store(new Request([
                'title' => 'User Added Successfully',
                'message' => 'User was added successfully.',
                'status' => 'Success'
            ]));

            return redirect()->route('users')->with('success', 'Reminder created successfully!');
        } catch (\Exception $e) {
            $notificationController->store(new Request([
                'title' => 'Error',
                'message' => 'An error occurred while adding users',
                'status' => 'Failed'
            ]));

            return redirect()->route('users')->with('failed', 'Reminder not created');
        }
    }

    private function scheduleReminders(Reminder $reminder)
    {
        $expireDate = Carbon::parse($reminder->expire_date);
        $reminderDates = [
            $reminder->reminder_date,          // 1 tahun sebelum expire (sudah diset di storeUsers)
            $expireDate->copy()->subMonths(6), // 6 bulan sebelum expire
            $expireDate->copy()->subMonths(3), // 3 bulan sebelum expire
            $expireDate->copy()->subDays(3),   // 3 hari sebelum expire
            $expireDate->copy()->subDays(2),   // 2 hari sebelum expire
            $expireDate->copy()->subDay(),     // 1 hari sebelum expire
            $expireDate,                       // pada hari expire
        ];

        foreach ($reminderDates as $date) {
            if ($date->isFuture()) {
                $message = $this->generateMessage($reminder, $date);
                $response = $this->sendScheduledMessage($reminder->phone_number, $message, $date->timestamp);

                Log::info('Reminder scheduled', [
                    'user' => $reminder->nama,
                    'phone' => $reminder->phone_number,
                    'date' => $date->format('Y-m-d H:i:s'),
                    'message' => $message,
                    'response' => $response
                ]);
            }
        }
    }

    private function generateMessage(Reminder $reminder, Carbon $date)
    {
        $expireDate = Carbon::parse($reminder->expire_date);
        $diffInDays = $date->diffInDays($expireDate);
        $diffInMonths = $date->diffInMonths($expireDate);

        if ($diffInDays == 0) {
            return "Hari ini adalah batas akhir masa berlaku data Anda. Harap segera perbarui data Anda.";
        } elseif ($diffInDays == 1) {
            return "Besok adalah batas akhir masa berlaku data Anda. Harap segera perbarui data Anda.";
        } elseif ($diffInDays == 2) {
            return "2 hari lagi adalah batas akhir masa berlaku data Anda. Harap segera perbarui data Anda.";
        } elseif ($diffInDays == 3) {
            return "3 hari lagi adalah batas akhir masa berlaku data Anda. Harap segera perbarui data Anda.";
        } elseif ($diffInMonths == 3) {
            return "3 bulan lagi adalah batas akhir masa berlaku data Anda. Mohon persiapkan pembaruan data Anda.";
        } elseif ($diffInMonths == 6) {
            return "6 bulan lagi adalah batas akhir masa berlaku data Anda. Mohon perhatikan untuk memperbarui data Anda tepat waktu.";
        } elseif ($diffInDays == 365) {
            return "1 tahun lagi adalah batas akhir masa berlaku data Anda. Mohon ingat untuk memperbarui data Anda tahun depan.";
        } else {
            return "Peringatan: Masa berlaku data Anda akan berakhir pada " . $expireDate->format('d F Y') . ". Harap perbarui data Anda sebelum tanggal tersebut.";
        }
    }

    private function sendScheduledMessage($phone_number, $message, $scheduleTimestamp)
    {
        $formattedPhone = $this->formatPhoneNumber($phone_number);
        $token = env('FONNTE_API_DEVICE_TOKEN');

        $curl = curl_init();

        $postFields = [
            'target' => $formattedPhone,
            'message' => $message,
            'schedule' => $scheduleTimestamp,
            'countryCode' => '62',
        ];

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postFields,
            CURLOPT_HTTPHEADER => [
                'Authorization:'. $token // Ganti dengan token Anda yang sebenarnya
            ],
        ]);

        $response = curl_exec($curl);
        $error = null;

        if (curl_errno($curl)) {
            $error = curl_error($curl);
        }

        curl_close($curl);

        if ($error) {
            Log::error('Failed to schedule message', [
                'phone' => $formattedPhone,
                'schedule' => date('Y-m-d H:i:s', $scheduleTimestamp),
                'error' => $error,
                'postFields' => $postFields
            ]);
        } else {
            Log::info('Message scheduled successfully', [
                'phone' => $formattedPhone,
                'schedule' => date('Y-m-d H:i:s', $scheduleTimestamp),
                'response' => $response,
                'postFields' => $postFields
            ]);
        }

        return $response;
    }

    private function formatPhoneNumber($phone_number)
    {
        $number = preg_replace('/[^0-9]/', '', $phone_number);
        if (substr($number, 0, 1) === '0') {
            $number = '62' . substr($number, 1);
        }
        if (substr($number, 0, 2) !== '62') {
            $number = '62' . $number;
        }
        return $number;
    }

    public function delete(Reminder $reminder)
    {
        $notificationController =  app(NotificationController::class);
        try {
            $reminder->delete();
            $notificationController->store(new Request([
                'title' => 'User Delete',
                'message' => 'User was deleted successfully.',
                'status' => 'Success'
            ]));
            return response()->json(['success' => true, 'message' => 'Reminder deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete reminder'], 500);
        }
    }

    public function search(Request $request)
    {
        Log::info('Search request received: ' . $request->get('search'));

        $notificationController =  app(NotificationController::class);

        try {
            $search = $request->get('search');

            $reminders = Reminder::where('nama', 'like', "%{$search}%")
                ->orWhere('phone_number', 'like', "%{$search}%")
                ->get();


            if ($request->successful()) {
                $notificationController->store(new Request([
                    'title' => 'Search Notification',
                    'message' => 'Showing result search',
                    'status' => 'Success'
                ]));

                return view('components.show', compact('reminders'));
                return response()->json($reminders);
            }
        } catch (\Exception $e) {

            Log::error('Search error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function index()
    {
        $reminders = Reminder::all();
        return view('reminders.index', compact('reminders'));
    }
}
