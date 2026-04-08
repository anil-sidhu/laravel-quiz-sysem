<?php

namespace App\Services;

use App\Contracts\SmsOtpSender;
use Illuminate\Support\Facades\Log;

class LogSmsOtpSender implements SmsOtpSender
{
    public function send(string $mobile, string $plainOtp, string $name): bool
    {
        Log::info('SMS OTP (log driver — not sent over network)', [
            'mobile' => $mobile,
            'otp' => $plainOtp,
            'name' => $name,
        ]);

        return true;
    }
}
