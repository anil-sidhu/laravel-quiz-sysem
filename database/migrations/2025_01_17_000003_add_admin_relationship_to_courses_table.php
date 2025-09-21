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
        Schema::table('courses', function (Blueprint $table) {
            // Check and add admin relationship fields only if they don't exist
            if (!Schema::hasColumn('courses', 'created_by_admin_id')) {
                $table->unsignedBigInteger('created_by_admin_id')->nullable()->after('description');
            }
            
            if (!Schema::hasColumn('courses', 'admin_assigned_at')) {
                $table->timestamp('admin_assigned_at')->nullable()->after('created_by_admin_id');
            }
        });
        
        // Add foreign key constraint separately (only if column exists and constraint doesn't exist)
        if (Schema::hasColumn('courses', 'created_by_admin_id')) {
            try {
                Schema::table('courses', function (Blueprint $table) {
                    $table->foreign('created_by_admin_id')->references('id')->on('admins')->onDelete('set null');
                });
            } catch (\Exception $e) {
                // Foreign key might already exist, ignore the error
                \Log::info('Admin foreign key constraint might already exist: ' . $e->getMessage());
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['created_by_admin_id']);
            $table->dropColumn(['created_by_admin_id', 'admin_assigned_at']);
        });
    }
};
