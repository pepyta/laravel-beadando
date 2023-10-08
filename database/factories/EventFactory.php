<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "type" => fake()->randomElement(["GOAL", "SELF_GOAL", "YELLOW_CARD", "RED_CARD"]),
            "minute" => fake()->numberBetween(0, 90),
        ];
    }
}
