<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "shortname",
        "image",
    ];

    public function players() {
        return $this->hasMany(Player::class)->orderBy("number");
    }

    public function games_as_home() {
        return $this->hasMany(Game::class, "home_team_id", "id");
    }

    public function games_as_away() {
        return $this->hasMany(Game::class, "away_team_id", "id");
    }

    public function events() {
        return $this->hasMany(Event::class);
    }

    public function getGamesAttribute() {
        $games = collect()
            ->merge($this->games_as_away)
            ->merge($this->games_as_home)
            ->sortByDesc("start");

        return $games;
    }

    public function getPointsAttribute() {
        $points = 0;
        $games = collect()
            ->merge($this->games_as_away)
            ->merge($this->games_as_home)
            ->where("finished", "=", true);

        foreach($games as $game) {
            $winner = $game->getWinner();
            if($winner == null) {
                $points += 1;
            } else if($winner->id == $this->id) {
                $points += 3;
            }
        }

        return $points;
    }

    public function getGoalDifferenceAttribute() {
        $goal_difference = 0;
        foreach($this->games_as_away as $game) {
            $goal_difference += $game->away_points - $game->home_points;
        }

        foreach($this->games_as_home as $game) {
            $goal_difference += $game->home_points - $game->away_points;
        }

        return $goal_difference;
    }

    public function getFavoriteAttribute() {
        if(Auth::guest()) return null;
        return Favorite::query()
            ->where("user_id", "=", Auth::user()->id)
            ->where("team_id", "=", $this->id)
            ->first();
    }
}
