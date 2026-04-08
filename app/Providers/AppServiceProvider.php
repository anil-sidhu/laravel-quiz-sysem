<?php

namespace App\Providers;

use App\Contracts\SmsOtpSender;
use App\Services\HttpSmsOtpSender;
use App\Services\LogSmsOtpSender;
use App\Services\SelfHostedSmsOtpService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SmsOtpSender::class, function () {
            return match (config('sms.driver', 'log')) {
                'http' => new HttpSmsOtpSender,
                default => new LogSmsOtpSender,
            };
        });

        $this->app->singleton(SelfHostedSmsOtpService::class, function ($app) {
            return new SelfHostedSmsOtpService($app->make(SmsOtpSender::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
