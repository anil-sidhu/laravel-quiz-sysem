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
        Schema::table('tutorials', function (Blueprint $table) {
            // Change description field to longText to handle large content
            $table->longText('description')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tutorials', function (Blueprint $table) {
            // Revert back to text if needed
            $table->text('description')->change();
        });
    }
};
