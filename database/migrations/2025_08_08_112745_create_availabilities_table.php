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
        Schema::create('availabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Host
            $table->string('type', ['specific_date', 'daily', 'weekly', 'monthly'])->default('weekly'); // 'weekly', 'specific_date'
            $table->string('day_of_week')->nullable(); // 'monday', 'tuesday', etc.
            $table->date('date')->nullable(); // For one-time availability
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('availabilities');
    }
};
