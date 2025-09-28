<?php
/**
 * Script to reset mobile verification for users registered before August 26, 2025
 * Upload this file to your cPanel public_html directory and run it via browser
 * 
 * URL: https://yourdomain.com/reset_old_users_verification.php
 */

// Include Laravel bootstrap
require_once __DIR__ . '/bootstrap/app.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

// Configuration
$cutoffDate = '2025-08-26 00:00:00';
$dryRun = isset($_GET['dry_run']) ? true : false;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Mobile Verification for Old Users</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header { background: #2c3e50; color: white; padding: 15px; margin: -20px -20px 20px -20px; border-radius: 8px 8px 0 0; }
        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin: 10px 0; }
        .warning { background: #fff3cd; color: #856404; padding: 10px; border-radius: 4px; margin: 10px 0; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin: 10px 0; }
        .info { background: #d1ecf1; color: #0c5460; padding: 10px; border-radius: 4px; margin: 10px 0; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f8f9fa; }
        .btn { background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block; margin: 5px; }
        .btn:hover { background: #0056b3; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
        .btn-success { background: #28a745; }
        .btn-success:hover { background: #218838; }
        .stats { display: flex; justify-content: space-around; margin: 20px 0; }
        .stat-box { background: #f8f9fa; padding: 15px; border-radius: 4px; text-align: center; flex: 1; margin: 0 5px; }
        .stat-number { font-size: 24px; font-weight: bold; color: #007bff; }
        .stat-label { font-size: 14px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔄 Reset Mobile Verification for Old Users</h1>
            <p>Force users registered before August 26, 2025 to go through Sharpener Tech OTP verification</p>
        </div>

        <?php
        try {
            // Get users who will be affected
            $affectedUsers = DB::table('users')
                ->where('created_at', '<', $cutoffDate)
                ->whereNotNull('mobile_verified_at')
                ->select('id', 'name', 'mobile', 'created_at', 'mobile_verified_at')
                ->orderBy('created_at', 'desc')
                ->get();

            // Get statistics
            $totalOldUsers = DB::table('users')
                ->where('created_at', '<', $cutoffDate)
                ->count();

            $unverifiedOldUsers = DB::table('users')
                ->where('created_at', '<', $cutoffDate)
                ->whereNull('mobile_verified_at')
                ->count();

            echo "<div class='info'>";
            echo "<h3>📊 Analysis Results</h3>";
            echo "<p><strong>Cutoff Date:</strong> {$cutoffDate}</p>";
            echo "<p><strong>Mode:</strong> " . ($dryRun ? "🔍 DRY RUN (no changes will be made)" : "⚡ LIVE RUN (changes will be made)") . "</p>";
            echo "</div>";

            // Statistics
            echo "<div class='stats'>";
            echo "<div class='stat-box'>";
            echo "<div class='stat-number'>{$totalOldUsers}</div>";
            echo "<div class='stat-label'>Total Old Users</div>";
            echo "</div>";
            echo "<div class='stat-box'>";
            echo "<div class='stat-number'>{$unverifiedOldUsers}</div>";
            echo "<div class='stat-label'>Already Unverified</div>";
            echo "</div>";
            echo "<div class='stat-box'>";
            echo "<div class='stat-number'>{$affectedUsers->count()}</div>";
            echo "<div class='stat-label'>Will Be Reset</div>";
            echo "</div>";
            echo "</div>";

            if ($affectedUsers->count() > 0) {
                echo "<div class='warning'>";
                echo "<h3>⚠️ Users That Will Be Affected</h3>";
                echo "<p>These users will need to verify their mobile number on next login through Sharpener Tech OTP verification.</p>";
                echo "</div>";

                // Show sample of affected users
                echo "<h3>📋 Sample of Affected Users (First 20)</h3>";
                echo "<table>";
                echo "<tr><th>ID</th><th>Name</th><th>Mobile</th><th>Created At</th><th>Verified At</th></tr>";
                
                foreach ($affectedUsers->take(20) as $user) {
                    echo "<tr>";
                    echo "<td>{$user->id}</td>";
                    echo "<td>" . htmlspecialchars(substr($user->name, 0, 30)) . "</td>";
                    echo "<td>{$user->mobile}</td>";
                    echo "<td>{$user->created_at}</td>";
                    echo "<td>" . ($user->mobile_verified_at ?? 'NULL') . "</td>";
                    echo "</tr>";
                }
                echo "</table>";

                if ($affectedUsers->count() > 20) {
                    echo "<p><em>... and " . ($affectedUsers->count() - 20) . " more users</em></p>";
                }

                // Action buttons
                if ($dryRun) {
                    echo "<div class='info'>";
                    echo "<h3>🔍 This was a DRY RUN</h3>";
                    echo "<p>No changes were made. To actually reset the mobile verification, click the button below.</p>";
                    echo "<a href='?execute=1' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to reset mobile verification for {$affectedUsers->count()} users? This action cannot be undone.\")'>⚡ Execute Reset ({$affectedUsers->count()} users)</a>";
                    echo "</div>";
                } else {
                    // Check if execute parameter is set
                    if (isset($_GET['execute'])) {
                        echo "<div class='warning'>";
                        echo "<h3>⚡ Executing Reset...</h3>";
                        echo "<p>Resetting mobile verification for {$affectedUsers->count()} users...</p>";
                        echo "</div>";

                        // Perform the update
                        $updatedCount = DB::table('users')
                            ->where('created_at', '<', $cutoffDate)
                            ->whereNotNull('mobile_verified_at')
                            ->update([
                                'mobile_verified_at' => null,
                                'updated_at' => now()
                            ]);

                        // Log the operation
                        Log::info('Mobile verification reset for old users via web script', [
                            'cutoff_date' => $cutoffDate,
                            'affected_users_count' => $updatedCount,
                            'script' => 'reset_old_users_verification.php'
                        ]);

                        echo "<div class='success'>";
                        echo "<h3>✅ Success!</h3>";
                        echo "<p>Successfully reset mobile verification for <strong>{$updatedCount}</strong> users.</p>";
                        echo "<p>These users will now need to verify their mobile number on next login through Sharpener Tech OTP verification.</p>";
                        echo "<p>Sharpener Tech will receive their data for lead tracking.</p>";
                        echo "</div>";
                    } else {
                        echo "<div class='warning'>";
                        echo "<h3>⚠️ Ready to Execute</h3>";
                        echo "<p>Click the button below to reset mobile verification for {$affectedUsers->count()} users.</p>";
                        echo "<a href='?execute=1' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to reset mobile verification for {$affectedUsers->count()} users? This action cannot be undone.\")'>⚡ Execute Reset ({$affectedUsers->count()} users)</a>";
                        echo "<a href='?dry_run=1' class='btn'>🔍 Dry Run Again</a>";
                        echo "</div>";
                    }
                }
            } else {
                echo "<div class='info'>";
                echo "<h3>ℹ️ No Users Need Reset</h3>";
                echo "<p>No users registered before {$cutoffDate} have mobile verification that needs to be reset.</p>";
                echo "</div>";
            }

            // Show impact analysis
            echo "<div class='info'>";
            echo "<h3>📈 Impact Analysis</h3>";
            echo "<ul>";
            echo "<li><strong>User Experience:</strong> Affected users will need to verify their mobile number on next login</li>";
            echo "<li><strong>Sharpener Tech:</strong> Will receive user data for lead tracking and analytics</li>";
            echo "<li><strong>One-time Process:</strong> Users only need to verify once</li>";
            echo "<li><strong>Lead Generation:</strong> Sharpener Tech gets access to your old user base</li>";
            echo "</ul>";
            echo "</div>";

        } catch (Exception $e) {
            echo "<div class='error'>";
            echo "<h3>❌ Error</h3>";
            echo "<p>An error occurred: " . htmlspecialchars($e->getMessage()) . "</p>";
            echo "</div>";
        }
        ?>

        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd;">
            <h3>🔧 Quick Actions</h3>
            <a href="?dry_run=1" class="btn">🔍 Dry Run</a>
            <a href="?" class="btn">🔄 Refresh</a>
            <a href="/" class="btn">🏠 Back to Site</a>
        </div>

        <div style="margin-top: 20px; font-size: 12px; color: #666;">
            <p><strong>Note:</strong> This script resets mobile verification for users registered before August 26, 2025. 
            This will force them to go through Sharpener Tech OTP verification on their next login, 
            enabling lead tracking for Sharpener Tech.</p>
        </div>
    </div>
</body>
</html>
