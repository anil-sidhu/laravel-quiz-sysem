<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SharpenerTechService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = env('SHARPENER_API_KEY', 'abcd1234apik3324324324ey');
        $this->baseUrl = env('SHARPENER_BASE_URL', 'https://test.sharpener.tech/api/sharpener-auth');
    }

    /**
     * Send OTP using Sharpener Tech API
     * @param string $mobile Mobile number
     * @param string $name User's name
     * @return array API response
     */
    public function sendOtp($mobile, $name)
    {
        $url = $this->baseUrl . '/send-otp';
        
        $payload = [
            'mobileNo' => $mobile,
            'name' => $name
        ];

        Log::info('Sharpener Tech Send OTP Request', [
            'url' => $url,
            'mobile' => $mobile,
            'name' => $name,
        ]);

        $response = Http::withHeaders([
            'API-KEY' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($url, $payload);

        Log::info('Sharpener Tech Send OTP Response', [
            'response' => $response->json(),
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return $response->json();
    }

    /**
     * Verify OTP using Sharpener Tech API
     * @param string $mobile Mobile number
     * @param string $otp OTP to verify
     * @param string $name User's name
     * @param array $utmData Optional UTM parameters
     * @return array API response
     */
    public function verifyOtp($mobile, $otp, $name, $utmData = [])
    {
        $url = $this->baseUrl . '/verify-otp';
        
        $payload = [
            'mobileNo' => $mobile,
            'otp' => $otp,
            'name' => $name
        ];

        // Add UTM data if provided
        if (!empty($utmData)) {
            $payload['utmData'] = $utmData;
        }

        Log::info('Sharpener Tech Verify OTP Request', [
            'url' => $url,
            'mobile' => $mobile,
            'otp' => $otp,
            'name' => $name,
            'utmData' => $utmData,
        ]);

        $response = Http::withHeaders([
            'API-KEY' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($url, $payload);

        Log::info('Sharpener Tech Verify OTP Response', [
            'response' => $response->json(),
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return $response->json();
    }

    /**
     * Resend OTP (same as send OTP)
     * @param string $mobile Mobile number
     * @param string $name User's name
     * @return array API response
     */
    public function resendOtp($mobile, $name)
    {
        return $this->sendOtp($mobile, $name);
    }
}
