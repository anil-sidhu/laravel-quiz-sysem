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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('certificate_id')->unique(); // e.g., "SHP-2026-A1B2C3"
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('student_name');
            $table->string('quiz_name');
            $table->integer('score');
            $table->timestamp('issued_at');
            $table->timestamps();
            
            // Index for faster lookups
            $table->index(['user_id', 'quiz_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
