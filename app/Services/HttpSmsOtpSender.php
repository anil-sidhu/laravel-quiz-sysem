<?php

namespace App\Services;

use App\Contracts\SmsOtpSender;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HttpSmsOtpSender implements SmsOtpSender
{
    public function send(string $mobile, string $plainOtp, string $name): bool
    {
        $url = config('sms.http.url');
        if (empty($url)) {
            Log::error('SMS http driver: SMS_API_URL is not set');

            return false;
        }

        $headers = array_filter(config('sms.http.headers', []));
        $payload = [
            'mobile' => $mobile,
            'otp' => $plainOtp,
            'name' => $name,
        ];

        try {
            $response = Http::withHeaders($headers)
                ->timeout((int) config('sms.http.timeout', 30))
                ->acceptJson()
                ->asJson()
                ->post($url, $payload);

            if ($response->successful()) {
                return true;
            }

            Log::warning('SMS http driver: non-success response', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return false;
        } catch (\Throwable $e) {
            Log::error('SMS http driver: request failed', [
                'error' => $e->getMessage(),
                'mobile' => $mobile,
            ]);

            return false;
        }
    }
}
