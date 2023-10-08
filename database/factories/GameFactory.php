<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $finished = fake()->boolean(95);
        if($finished) {
            $start = fake()->dateTimeBetween("-10 years", "now");
        } else {
            $ongoing = fake()->boolean(60);

            if($ongoing) {
                $start = fake()->dateTimeBetween("-90 minutes", "now");
            } else {
                $start = fake()->dateTimeBetween("now", "+1 years");
            }
        }

        return [
            "start" => $start,
            "finished" => $finished,
        ];
    }
}
