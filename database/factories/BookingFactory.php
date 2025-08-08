<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\EventType;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTime = $this->faker->dateTimeBetween('now', '+1 month');
        $eventType = EventType::factory()->create();
        $status = ['confirmed', 'pending', 'rescheduled', 'cancelled'];
        $user_id = User::factory()->create()->id;

        return [
            'event_type_id' => $eventType->id,
            'host_id' => $eventType->user_id,
            'attendee_id' => $user_id,
            'status' => $this->faker->randomElement($status),
            'start_time' => $startTime,
            'end_time' => (clone $startTime)->modify("+{$eventType->duration} minutes"),
            'notes' => $this->faker->sentence,
            'timezone' => $this->faker->timezone,
            'meeting_link' => 'https://meet.google.com/' . Str::slug(User::find($user_id)->name),
        ];
    }
}
