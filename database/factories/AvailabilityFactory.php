<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Availability>
 */
class AvailabilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTime = $this->faker->time('H:i');

        $types = ['daily', 'weekly', 'monthly', 'specific_date'];
        return [
            'user_id' => User::factory()->create()->id,
            'type' => $this->faker->randomElement($types),
            'day_of_week' => $this->faker->dayOfWeek,
            'start_time' => $startTime,
            'end_time' => date('H:i', strtotime($startTime) + $this->faker->numberBetween(1, 8) * 3600),
        ];
    }


    public function specificDate()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'specific_date',
                'date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
                'day_of_week' => null,
            ];
        });
    }
}
