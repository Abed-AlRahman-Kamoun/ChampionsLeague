<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['name', 'team', 'played', 'won', 'drawn', 'lost', 'goals_for', 'goals_against', 'points'];

    protected $appends = [
        'goal_difference'
    ];

    public function homeGames()
    {
        return $this->hasMany(Game::class, 'home_player_id');
    }

    public function awayGames()
    {
        return $this->hasMany(Game::class, 'away_player_id');
    }

    public function getGoalDifferenceAttribute()
    {
        return $this->goals_for - $this->goals_against;
    }
}
