<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventType>
 */
class EventTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $durations = [15, 30, 45, 60];

        return [
            'user_id' => User::factory()->create()->id,
            'name' => $this->faker->words(3, true) . ' Meeting',
            'duration' => $this->faker->randomElement($durations),
            'description' => $this->faker->paragraph,
            'color' => $this->faker->hexColor,
            'requires_confirmation' => $this->faker->boolean(20),
        ];
    }
}
