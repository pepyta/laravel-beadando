<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    private static $number_of_events = 600;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $games = Game::all();
        for($i = 0; $i < EventSeeder::$number_of_events; $i++) {
            $game = $games->random();
            if($game->start < now()) {
                $team = collect([$game->home, $game->away])->random();
                Event::factory()->create([
                    "game_id" => $game->id,
                    "team_id" => $team->id,
                    "player_id" => $team->players->random()->id,
                ]);
            }
        }
    }
}
