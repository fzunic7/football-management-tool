<?php

namespace Database\Seeders;

use App\Models\Matches;
use App\Models\Player;
use App\Models\Result;
use App\Models\Team;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Team::factory()->count(10)->create();
        Player::factory()->count(50)->create();

        Matches::factory()
          ->count(5)
          ->has(Result::factory()) // Create associated results
          ->create();
    }
}
