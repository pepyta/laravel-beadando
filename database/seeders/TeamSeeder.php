<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Team;

class TeamSeeder extends Seeder
{
    public static $number_of_teams = 15;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < TeamSeeder::$number_of_teams; $i++) {
            Team::factory()->create();
        }
    }
}
