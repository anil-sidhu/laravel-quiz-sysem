<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Reset mobile_verified_at to NULL for users registered before August 26, 2025
        // This will force them to go through Sharpener Tech OTP verification on next login
        
        $cutoffDate = '2025-08-26 00:00:00';
        
        // Update users who were registered before the cutoff date
        $affectedUsers = DB::table('users')
            ->where('created_at', '<', $cutoffDate)
            ->whereNotNull('mobile_verified_at')
            ->update([
                'mobile_verified_at' => null,
                'updated_at' => now()
            ]);
        
        // Log the number of users affected
        \Log::info('Mobile verification reset for old users', [
            'cutoff_date' => $cutoffDate,
            'affected_users_count' => $affectedUsers,
            'migration' => 'reset_mobile_verification_for_old_users'
        ]);
        
        echo "Reset mobile verification for {$affectedUsers} users registered before {$cutoffDate}\n";
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration cannot be easily reversed as we don't know the original mobile_verified_at values
        // If you need to reverse this, you would need to restore from a backup
        echo "Warning: This migration cannot be reversed. Original mobile_verified_at values are lost.\n";
        echo "If you need to reverse this, restore from a database backup.\n";
    }
};