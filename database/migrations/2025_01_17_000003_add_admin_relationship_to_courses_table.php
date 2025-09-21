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
            // Add admin relationship to track who created each course
            $table->unsignedBigInteger('created_by_admin_id')->nullable()->after('description');
            $table->timestamp('admin_assigned_at')->nullable()->after('created_by_admin_id');
            
            // Add foreign key constraint (assuming admins table exists)
            $table->foreign('created_by_admin_id')->references('id')->on('admins')->onDelete('set null');
        });
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
