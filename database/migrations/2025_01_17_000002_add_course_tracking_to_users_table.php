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
            // Add course tracking fields
            $table->unsignedBigInteger('signup_source_course_id')->nullable()->after('mobile_verified_at');
            $table->string('signup_source_page_url', 500)->nullable()->after('signup_source_course_id');
            $table->enum('signup_source_type', ['course_page', 'topic_page', 'homepage', 'other'])->default('other')->after('signup_source_page_url');
            $table->timestamp('signup_tracked_at')->nullable()->after('signup_source_type');
            
            // Add foreign key constraint
            $table->foreign('signup_source_course_id')->references('id')->on('courses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['signup_source_course_id']);
            $table->dropColumn([
                'signup_source_course_id',
                'signup_source_page_url', 
                'signup_source_type',
                'signup_tracked_at'
            ]);
        });
    }
};
