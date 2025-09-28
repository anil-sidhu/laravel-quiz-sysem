<?php

/**
 * Script to check which users will be affected by mobile verification reset
 * Run this before the migration to see the impact
 */

require_once __DIR__ . '/../../vendor/autoload.php';

use Illuminate\Support\Facades\DB;

// Bootstrap Laravel
$app = require_once __DIR__ . '/../../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$cutoffDate = '2025-08-26 00:00:00';

echo "=== Mobile Verification Reset Analysis ===\n";
echo "Cutoff Date: {$cutoffDate}\n\n";

// Get users who will be affected
$affectedUsers = DB::table('users')
    ->where('created_at', '<', $cutoffDate)
    ->whereNotNull('mobile_verified_at')
    ->select('id', 'name', 'mobile', 'created_at', 'mobile_verified_at')
    ->orderBy('created_at', 'desc')
    ->get();

echo "Users who will have mobile verification reset:\n";
echo "Total Count: " . $affectedUsers->count() . "\n\n";

if ($affectedUsers->count() > 0) {
    echo "Sample of affected users (first 10):\n";
    echo str_pad('ID', 8) . str_pad('Name', 20) . str_pad('Mobile', 15) . str_pad('Created', 20) . str_pad('Verified At', 20) . "\n";
    echo str_repeat('-', 85) . "\n";
    
    foreach ($affectedUsers->take(10) as $user) {
        echo str_pad($user->id, 8) . 
             str_pad(substr($user->name, 0, 19), 20) . 
             str_pad($user->mobile, 15) . 
             str_pad($user->created_at, 20) . 
             str_pad($user->mobile_verified_at ?? 'NULL', 20) . "\n";
    }
    
    if ($affectedUsers->count() > 10) {
        echo "... and " . ($affectedUsers->count() - 10) . " more users\n";
    }
}

// Get total users before cutoff
$totalOldUsers = DB::table('users')
    ->where('created_at', '<', $cutoffDate)
    ->count();

// Get users already without verification
$unverifiedOldUsers = DB::table('users')
    ->where('created_at', '<', $cutoffDate)
    ->whereNull('mobile_verified_at')
    ->count();

echo "\n=== Summary ===\n";
echo "Total users before {$cutoffDate}: {$totalOldUsers}\n";
echo "Users already unverified: {$unverifiedOldUsers}\n";
echo "Users that will be reset: " . $affectedUsers->count() . "\n";
echo "Users that will remain verified: " . ($totalOldUsers - $affectedUsers->count() - $unverifiedOldUsers) . "\n";

echo "\n=== Impact Analysis ===\n";
echo "These users will need to verify their mobile number on next login.\n";
echo "They will go through Sharpener Tech OTP verification process.\n";
echo "Sharpener Tech will receive their data for lead tracking.\n";

echo "\nDo you want to proceed with the migration? (y/n): ";
$handle = fopen("php://stdin", "r");
$line = fgets($handle);
if (trim($line) === 'y') {
    echo "Running migration...\n";
    // Run the migration
    \Artisan::call('migrate', ['--path' => 'database/migrations/2025_09_28_195311_reset_mobile_verification_for_old_users.php']);
    echo "Migration completed!\n";
} else {
    echo "Migration cancelled.\n";
}
fclose($handle);
