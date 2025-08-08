<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\EventType;
use App\Models\Availability;
use App\Models\Booking;

class EventPlannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 hosts
        $hosts = User::factory()
            ->count(5)
            ->has(
                EventType::factory()
                    ->count(3)
            )
            ->has(
                Availability::factory()
                    ->count(5)
            )
            ->create();

        // Create 20 regular users (attendees)
        $attendees = User::factory()
            ->count(20)
            ->create();

        // Create bookings
        Booking::factory()
            ->count(50)
            ->create();
    }
}
