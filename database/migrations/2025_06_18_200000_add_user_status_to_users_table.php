<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove call_sent if it exists
            if (Schema::hasColumn('users', 'call_sent')) {
                $table->dropColumn('call_sent');
            }
            // Add user_status
            $table->enum('user_status', ['Not Interested', 'Interested', 'Joined', 'Follow up Required'])->default('Not Interested')->after('leads');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_status');
            // Optionally, you could re-add call_sent here if needed
        });
    }
}; 