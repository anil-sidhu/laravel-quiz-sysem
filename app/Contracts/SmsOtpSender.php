<?php

namespace App\Contracts;

interface SmsOtpSender
{
    /**
     * Deliver the one-time password to the user's phone.
     */
    public function send(string $mobile, string $plainOtp, string $name): bool;
}
