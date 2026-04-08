<?php

return [

    /*
    |--------------------------------------------------------------------------
    | SMS OTP driver
    |--------------------------------------------------------------------------
    |
    | "log" — OTP is written to the application log (default for local/dev).
    | "http" — POST JSON to SMS_API_URL (configure headers/body below).
    |
    */

    'driver' => env('SMS_DRIVER', 'log'),

    /*
    | When true, no user is asked for SMS OTP (signup/login auto-verify mobile).
    | Set BYPASS_SMS_OTP=false in .env when your SMS API is ready; India will
    | require OTP again and other countries will keep bypassing (see shouldBypassOtp).
    */
    'bypass_all_otp' => filter_var(env('BYPASS_SMS_OTP', true), FILTER_VALIDATE_BOOLEAN),

    'otp_length' => (int) env('SMS_OTP_LENGTH', 6),

    'otp_ttl_minutes' => (int) env('SMS_OTP_TTL_MINUTES', 10),

    'http' => [
        'url' => env('SMS_API_URL'),
        'timeout' => (int) env('SMS_API_TIMEOUT', 30),
        'headers' => array_filter([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => env('SMS_API_AUTH_HEADER'),
            'X-API-Key' => env('SMS_API_KEY'),
        ]),
    ],

];
