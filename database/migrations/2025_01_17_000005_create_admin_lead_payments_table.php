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
        Schema::create('admin_lead_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('user_id'); // The lead/signup
            $table->unsignedBigInteger('course_id'); // Course that generated the lead
            $table->decimal('lead_value', 8, 2); // Value of this lead (e.g., $50)
            $table->decimal('commission_rate', 5, 2); // Commission rate at time of lead
            $table->decimal('commission_amount', 8, 2); // Calculated commission
            $table->enum('payment_status', ['pending', 'paid', 'cancelled'])->default('pending');
            $table->enum('lead_quality', ['signup', 'interested', 'converted', 'premium'])->default('signup');
            $table->timestamp('lead_generated_at');
            $table->timestamp('payment_due_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

            // Indexes for performance
            $table->index(['admin_id', 'payment_status']);
            $table->index(['course_id', 'lead_generated_at']);
            $table->index('payment_due_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_lead_payments');
    }
};
