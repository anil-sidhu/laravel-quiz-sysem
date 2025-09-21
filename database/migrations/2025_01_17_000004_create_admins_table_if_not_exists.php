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
        // Only create admins table if it doesn't exist
        if (!Schema::hasTable('admins')) {
            Schema::create('admins', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('role')->default('content_creator'); // content_creator, super_admin, etc.
                $table->boolean('is_active')->default(true);
                $table->timestamp('last_login_at')->nullable();
                $table->rememberToken();
                $table->timestamps();
            });
        } else {
            // If table exists, add missing columns (only basic tracking fields)
            Schema::table('admins', function (Blueprint $table) {
                if (!Schema::hasColumn('admins', 'role')) {
                    $table->string('role')->default('content_creator')->after('password');
                }
                if (!Schema::hasColumn('admins', 'is_active')) {
                    $table->boolean('is_active')->default(true)->after('role');
                }
                if (!Schema::hasColumn('admins', 'last_login_at')) {
                    $table->timestamp('last_login_at')->nullable()->after('is_active');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Only drop if we created it in this migration
        if (Schema::hasTable('admins')) {
            Schema::dropIfExists('admins');
        }
    }
};
