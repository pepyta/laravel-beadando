<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "team_id",
    ];

    public function team() {
        return $this->hasOne(Game::class, "id", "team_id");
    }

    public function user() {
        return $this->hasOne(User::class, "id", "user_id");
    }
}
