<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->get_fullname();
        $shortname = $this->get_shortname($name);
        return [
            "name" => $name,
            "shortname" => $shortname,
        ];
    }

    private function get_club_type()
    {
        $types = collect([
            "Sport Club",
            "Footbal Club",
            "Athletic Club",
        ]);

        return $types->random();
    }

    public function get_fullname()
    {
        return fake()->unique()->city() . " " . $this->get_club_type();
    }

    private function get_shortname($name, $retries = 0)
    {
        $parts = explode(" ", $name);
        $shortname = Str::upper(
            join(
                "",
                [
                    substr($parts[0], 0, 2),
                    substr($parts[count($parts) - 2], 0, 1),
                    substr($parts[count($parts) - 1], 0, 1),
                ]
            )
        );

        if($retries > 0) {
            $shortname .= $retries;
        }

        $found = Team::where("shortname", "=", $shortname)->count() > 0;
        if($found) return $this->get_shortname($name, $retries + 1);
        return $shortname;
    }
}
