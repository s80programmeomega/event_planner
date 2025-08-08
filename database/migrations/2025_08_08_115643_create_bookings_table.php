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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('host_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('attendee_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['confirmed', 'pending', 'rescheduled', 'cancelled'])->default('confirmed'); 
            $table->timestamp('start_time'); // UTC
            $table->timestamp('end_time'); // UTC
            $table->text('notes')->nullable();
            $table->string('timezone'); // Attendee's timezone
            $table->string('meeting_link')->nullable(); // Zoom/Google Meet URL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
