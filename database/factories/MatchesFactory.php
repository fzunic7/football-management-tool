<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Matches>
 */
class MatchesFactory extends Factory
{
  protected $model = \App\Models\Matches::class;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'team_1_id' => \App\Models\Team::factory(),
      'team_2_id' => \App\Models\Team::factory(),
      'match_date' => $this->faker->dateTimeBetween('-1 year', 'today'),
    ];
  }
}
