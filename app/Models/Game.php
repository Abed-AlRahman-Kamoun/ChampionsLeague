<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['home_player_id', 'away_player_id', 'home_score', 'away_score', 'played'];

    public function homePlayer()
    {
        return $this->belongsTo(Player::class, 'home_player_id');
    }

    public function awayPlayer()
    {
        return $this->belongsTo(Player::class, 'away_player_id');
    }
}
