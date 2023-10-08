<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        "start",
        "home_team_id",
        "away_team_id",
        "finished",
    ];


    protected $casts = [
        'start' => 'datetime',
    ];

    public function home() {
        return $this->hasOne(Team::class, "id", "home_team_id");
    }

    public function away() {
        return $this->hasOne(Team::class, "id", "away_team_id");
    }

    public function events() {
        return $this->hasMany(Event::class);
    }

    protected $appends = ['home_points', 'away_points'];

    /**
     * Gets the points for a given team (id) by counting the self goals of the other team and the number of regular goals.
     */
    private function getTeamPoints($team_id) {
        return (
            $this->events->where("team_id", '=', $team_id)->where("type", '=', "GOAL")->count()
            + $this->events->where("team_id", '!=', $team_id)->where("type", '=', "SELF_GOAL")->count()
        );
    }

    public function getHomePointsAttribute()
    {
        return $this->getTeamPoints($this->home_team_id);
    }

    public function getAwayPointsAttribute()
    {
        return $this->getTeamPoints($this->away_team_id);
    }

    public function getScheduledAttribute() {
        return !$this->finished && $this->start->timestamp > now()->timestamp;
    }

    public function getOngoingAttribute() {
        return !$this->finished && $this->start->timestamp <= now()->timestamp;
    }

    public function getWinner() {
        $away_points = $this->getAwayPointsAttribute();
        $home_points = $this->getHomePointsAttribute();

        if($home_points > $away_points) {
            return $this->home;
        } else if($home_points < $away_points) {
            return $this->away;
        } else {
            return null;
        }
    }
}
