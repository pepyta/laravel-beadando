<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "number",
        "birthdate",
        "team_id",
    ];

    protected $casts = [
        "birthdate" => "date",
    ];

    public function team() {
        return $this->belongsTo(Team::class);
    }

    public function events() {
        return $this->hasMany(Event::class);
    }

    public function getYellowCardsAttribute() {
        return $this->events
            ->where("type", "YELLOW_CARD")
            ->count();
    }

    public function getRedCardsAttribute() {
        return $this->events
            ->where("type", "RED_CARD")
            ->count();
    }

    public function getGoalsAttribute() {
        return $this->events
            ->where("type", "GOAL")
            ->count();
    }

    public function getSelfGoalsAttribute() {
        return $this->events
            ->where("type", "SELF_GOAL")
            ->count();
    }
}
