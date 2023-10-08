<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    private static $number_of_players_in_a_team = 16;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = Team::all();

        foreach($teams as $team) {
            for($i = 0; $i < PlayerSeeder::$number_of_players_in_a_team; $i++) {
                Player::factory([
                    "team_id" => $team->id,
                    "number" => $i + 1,
                ])->create();
            }
        }
    }
}
