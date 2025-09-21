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
                $table->decimal('commission_rate', 5, 2)->default(10.00); // 10% default commission
                $table->decimal('total_earnings', 10, 2)->default(0.00);
                $table->integer('total_leads_generated')->default(0);
                $table->timestamp('last_login_at')->nullable();
                $table->rememberToken();
                $table->timestamps();
            });
        } else {
            // If table exists, add missing columns
            Schema::table('admins', function (Blueprint $table) {
                if (!Schema::hasColumn('admins', 'role')) {
                    $table->string('role')->default('content_creator')->after('password');
                }
                if (!Schema::hasColumn('admins', 'is_active')) {
                    $table->boolean('is_active')->default(true)->after('role');
                }
                if (!Schema::hasColumn('admins', 'commission_rate')) {
                    $table->decimal('commission_rate', 5, 2)->default(10.00)->after('is_active');
                }
                if (!Schema::hasColumn('admins', 'total_earnings')) {
                    $table->decimal('total_earnings', 10, 2)->default(0.00)->after('commission_rate');
                }
                if (!Schema::hasColumn('admins', 'total_leads_generated')) {
                    $table->integer('total_leads_generated')->default(0)->after('total_earnings');
                }
                if (!Schema::hasColumn('admins', 'last_login_at')) {
                    $table->timestamp('last_login_at')->nullable()->after('total_leads_generated');
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
