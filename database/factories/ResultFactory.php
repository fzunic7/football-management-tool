<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Result>
 */
class ResultFactory extends Factory
{
  protected $model = \App\Models\Result::class;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
    public function definition(): array
    {
        return [
            'matches_id' => \App\Models\Matches::factory(),
            'team_1_score' => $this->faker->numberBetween(0, 5),
            'team_2_score' => $this->faker->numberBetween(0, 5),
        ];
    }
}
