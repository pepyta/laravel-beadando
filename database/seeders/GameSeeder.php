<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = Team::all();

        foreach($teams as $home) {
            foreach($teams as $away) {
                if($away == $home) continue;
                Game::factory()->create([
                    "home_team_id" => $home->id,
                    "away_team_id" => $away->id,
                ]);
            }
        }
    }
}
