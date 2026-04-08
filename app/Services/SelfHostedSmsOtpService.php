<?php

namespace App\Services;

use App\Contracts\SmsOtpSender;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class SelfHostedSmsOtpService
{
    public function __construct(
        private SmsOtpSender $sender
    ) {}

    /**
     * Generate OTP, persist hashed value + expiry, send plain OTP via SMS transport.
     *
     * @return array{status: string, message?: string}
     */
    public function sendOtpForUser(User $user): array
    {
        $length = max(4, min(8, (int) config('sms.otp_length', 6)));
        $min = 10 ** ($length - 1);
        $max = (10 ** $length) - 1;
        $plain = (string) random_int($min, $max);

        $user->otp_code = Hash::make($plain);
        $user->otp_expires_at = now()->addMinutes((int) config('sms.otp_ttl_minutes', 10));
        $user->save();

        $sent = $this->sender->send($user->mobile, $plain, $user->name);

        if (! $sent) {
            $user->otp_code = null;
            $user->otp_expires_at = null;
            $user->save();

            return [
                'status' => 'error',
                'message' => 'Failed to send OTP. Please try again.',
            ];
        }

        return ['status' => 'success'];
    }

    /**
     * @return array{status: string, message?: string}
     */
    public function verifyOtpForUser(User $user, string $otp): array
    {
        if (empty($user->otp_code) || empty($user->otp_expires_at)) {
            return [
                'status' => 'error',
                'message' => 'Invalid or expired OTP.',
            ];
        }

        if ($user->otp_expires_at->isPast()) {
            return [
                'status' => 'error',
                'message' => 'Invalid or expired OTP.',
            ];
        }

        if (! Hash::check($otp, $user->otp_code)) {
            return [
                'status' => 'error',
                'message' => 'Invalid or expired OTP.',
            ];
        }

        return ['status' => 'success'];
    }
}
