<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;

    public function team1()
    {
      return $this->belongsTo(Team::class, 'team_1_id');
    }
    public function team2()
    {
      return $this->belongsTo(Team::class, 'team_2_id');
    }
    public function result()
    {
      return $this->hasOne(Result::class);
    }
}
