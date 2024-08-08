<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FonnteService
{
    protected $url;
    protected $token;


    public static function getDevices()
    {
        $response = Http::withHeaders([
            'Authorization' => 'fDN@8#NQbnj51e7Dz_cDBrLxVry4NUqyEq#u_mNetJwh!9AT',
        ])->post('https://api.fonnte.com/get-devices');

        // Decode response
        return $response->json();

        if (isset($data['name']) && isset($data['device'])) {
            return $data;
        }

        // Jika data tidak sesuai dengan yang diharapkan
        return ['status' => false, 'error' => 'Unexpected response format'];

    }

    public function __construct()
    {
        $this->url = config('fonnte.url');
        $this->token = config('fonnte.token');
    }

    public function sendMessage($target, $message, $url = null, $filename = null, $file = null, $location = null, $schedule = 0, $typing = false, $delay = 2, $countryCode = '62', $followup = 0)
    {
        $data = [
            'target' => $target,
            'message' => $message,
            'url' => $url,
            'filename' => $filename,
            'schedule' => $schedule,
            'typing' => $typing,
            'delay' => $delay,
            'countryCode' => $countryCode,
            'followup' => $followup,
        ];

        if ($file) {
            $data['file'] = new \CURLFile($file);
        }

        if ($location) {
            $data['location'] = $location;
        }

        $response = Http::withHeaders([
            'Authorization' => $this->token,
        ])->asMultipart()->post($this->url, $data);

        if ($response->failed()) {
            return $response->body();
        }

        return $response->json();
    }
}
