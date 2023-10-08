<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::query()
            ->with(["games_as_home", "games_as_home.events", "games_as_home.events.team", "games_as_home.home", "games_as_home.away"])
            ->with(["games_as_away", "games_as_away.events", "games_as_away.events.team", "games_as_away.home", "games_as_away.away"])
            ->get()
            ->sortBy("name")
            ->sortByDesc("goal_difference")
            ->sortByDesc("points");

        return view("leaderboard.index", [
            "teams" => $teams,
        ]);
    }
}
