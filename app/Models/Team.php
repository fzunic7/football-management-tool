<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function players()
    {
        return $this->hasMany(Player::class);
    }
    public function matchesAsTeam1()
    {
        return $this->hasMany(Matches::class, 'team_1_id');
    }
    public function matchesAsTeam2()
    {
        return $this->hasMany(Matches::class, 'team_2_id');
    }
}
