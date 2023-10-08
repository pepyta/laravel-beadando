<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->name(),
            'email' => $this->get_email(fake()->unique()->numberBetween(1, 2048)),
            'email_verified_at' => now(),
            'password' => password_hash("password", PASSWORD_DEFAULT), // password
            'remember_token' => Str::random(10),
        ];
    }

    private function get_email($number) {
        return "user".$number."@szerveroldali.hu";
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
