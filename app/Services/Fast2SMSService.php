<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Fast2SMSService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('FAST2SMS_API_KEY');
    }

    /**
     * Send OTP SMS using Fast2SMS OTP route
     * @param string $mobile 10-digit mobile number (India)
     * @param string $otp The OTP to send
     * @return array Fast2SMS API response
     */
    public function sendOtp($mobile, $otp)
    {
        $url = 'https://www.fast2sms.com/dev/bulkV2';
        $message = "$otp is your CodingSkills verification code. For your security do not share this code.";

        Log::info('Fast2SMS OTP Request', [
            'url' => $url,
            'mobile' => $mobile,
            'otp' => $otp,
            'message' => $message,
        ]);

        $response = Http::withHeaders([
            'authorization' => $this->apiKey,
            'cache-control' => 'no-cache',
        ])->asForm()->post($url, [
            'route' => 'otp', // 'otp' for OTP SMS route
            'variables_values' => $otp,
            'flash' => 0, // send as flash SMS
            'message' => $message,
            'language' => 'english',
            'numbers' => $mobile,
        ]);

        Log::info('Fast2SMS OTP Response', [
            'response' => $response->json(),
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return $response->json();
    }
} 