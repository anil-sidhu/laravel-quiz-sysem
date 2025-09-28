<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResetOldUsersMobileVerification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:reset-mobile-verification {--cutoff=2025-08-26} {--dry-run : Show what would be affected without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset mobile verification for users registered before a specific date to force Sharpener Tech OTP verification';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cutoffDate = $this->option('cutoff') . ' 00:00:00';
        $dryRun = $this->option('dry-run');
        
        $this->info("=== Mobile Verification Reset Analysis ===");
        $this->info("Cutoff Date: {$cutoffDate}");
        $this->info("Mode: " . ($dryRun ? "DRY RUN (no changes will be made)" : "LIVE RUN (changes will be made)"));
        $this->newLine();

        // Get users who will be affected
        $affectedUsers = DB::table('users')
            ->where('created_at', '<', $cutoffDate)
            ->whereNotNull('mobile_verified_at')
            ->select('id', 'name', 'mobile', 'created_at', 'mobile_verified_at')
            ->orderBy('created_at', 'desc')
            ->get();

        $this->info("Users who will have mobile verification reset: {$affectedUsers->count()}");
        $this->newLine();

        if ($affectedUsers->count() > 0) {
            $this->info("Sample of affected users (first 10):");
            $this->table(
                ['ID', 'Name', 'Mobile', 'Created At', 'Verified At'],
                $affectedUsers->take(10)->map(function ($user) {
                    return [
                        $user->id,
                        substr($user->name, 0, 20),
                        $user->mobile,
                        $user->created_at,
                        $user->mobile_verified_at ?? 'NULL'
                    ];
                })->toArray()
            );
            
            if ($affectedUsers->count() > 10) {
                $this->info("... and " . ($affectedUsers->count() - 10) . " more users");
            }
        }

        // Get statistics
        $totalOldUsers = DB::table('users')
            ->where('created_at', '<', $cutoffDate)
            ->count();

        $unverifiedOldUsers = DB::table('users')
            ->where('created_at', '<', $cutoffDate)
            ->whereNull('mobile_verified_at')
            ->count();

        $this->newLine();
        $this->info("=== Summary ===");
        $this->info("Total users before {$cutoffDate}: {$totalOldUsers}");
        $this->info("Users already unverified: {$unverifiedOldUsers}");
        $this->info("Users that will be reset: {$affectedUsers->count()}");
        $this->info("Users that will remain verified: " . ($totalOldUsers - $affectedUsers->count() - $unverifiedOldUsers));

        $this->newLine();
        $this->info("=== Impact Analysis ===");
        $this->info("These users will need to verify their mobile number on next login.");
        $this->info("They will go through Sharpener Tech OTP verification process.");
        $this->info("Sharpener Tech will receive their data for lead tracking.");

        if ($dryRun) {
            $this->newLine();
            $this->warn("This was a DRY RUN. No changes were made.");
            $this->info("To actually make the changes, run the command without --dry-run flag.");
            return;
        }

        if ($affectedUsers->count() === 0) {
            $this->info("No users need mobile verification reset.");
            return;
        }

        $this->newLine();
        if (!$this->confirm("Do you want to proceed with resetting mobile verification for {$affectedUsers->count()} users?")) {
            $this->info("Operation cancelled.");
            return;
        }

        // Perform the update
        $this->info("Resetting mobile verification...");
        
        $updatedCount = DB::table('users')
            ->where('created_at', '<', $cutoffDate)
            ->whereNotNull('mobile_verified_at')
            ->update([
                'mobile_verified_at' => null,
                'updated_at' => now()
            ]);

        // Log the operation
        Log::info('Mobile verification reset for old users', [
            'cutoff_date' => $cutoffDate,
            'affected_users_count' => $updatedCount,
            'command' => 'users:reset-mobile-verification'
        ]);

        $this->info("✅ Successfully reset mobile verification for {$updatedCount} users.");
        $this->info("These users will now need to verify their mobile number on next login.");
        $this->info("They will go through Sharpener Tech OTP verification process.");
    }
}