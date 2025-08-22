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
            'apiKey' => substr($this->apiKey, 0, 10) . '...', // Log partial API key for debugging
            'payload' => $payload,
        ]);

        try {
            $response = Http::withHeaders([
                'API-KEY' => $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'User-Agent' => 'Laravel-Quiz-System/1.0',
            ])->timeout(30)->post($url, $payload);

            Log::info('Sharpener Tech Send OTP Response', [
                'response' => $response->json(),
                'status' => $response->status(),
                'body' => $response->body(),
                'headers' => $response->headers(),
            ]);

            return $response->json();
        } catch (\Exception $e) {
            Log::error('Sharpener Tech Send OTP Error', [
                'error' => $e->getMessage(),
                'mobile' => $mobile,
                'name' => $name,
            ]);
            throw $e;
        }
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

    /**
     * Test API connectivity and configuration
     * @return array Test results
     */
    public function testApiConnection()
    {
        $testMobile = '8285537543';
        $testName = 'Test User';
        
        Log::info('Sharpener Tech API Test', [
            'apiKey' => substr($this->apiKey, 0, 10) . '...',
            'baseUrl' => $this->baseUrl,
            'testMobile' => $testMobile,
            'testName' => $testName,
        ]);

        try {
            $result = $this->sendOtp($testMobile, $testName);
            
            return [
                'success' => true,
                'apiKey' => substr($this->apiKey, 0, 10) . '...',
                'baseUrl' => $this->baseUrl,
                'response' => $result,
                'message' => 'API test completed successfully'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'apiKey' => substr($this->apiKey, 0, 10) . '...',
                'baseUrl' => $this->baseUrl,
                'error' => $e->getMessage(),
                'message' => 'API test failed'
            ];
        }
    }
}
