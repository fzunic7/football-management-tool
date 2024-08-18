<?php

namespace Tests\Feature;

use App\Models\Matches;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MatchesControllerTest extends TestCase
{
  use RefreshDatabase;

  protected function setUp(): void
  {
    parent::setUp();
    $this->seed();
  }

  /** @test */
  public function it_can_create_a_match()
  {
    $teams = Team::factory()->count(2)->create();

    $response = $this->post(route('matches.store'), [
      'team_1_id' => $teams[0]->id,
      'team_2_id' => $teams[1]->id,
      'match_date' => '2024-08-18',
    ]);

    $response->assertRedirect(route('matches.index'));
    $this->assertDatabaseHas('matches', [
      'team_1_id' => $teams[0]->id,
      'team_2_id' => $teams[1]->id,
      'match_date' => '2024-08-18',
    ]);
  }

  /** @test */
  public function it_can_update_a_match()
  {
    $teams = Team::factory()->count(3)->create();
    $match = Matches::factory()->create([
      'team_1_id' => $teams[0]->id,
      'team_2_id' => $teams[1]->id,
      'match_date' => '2024-08-17',
    ]);

    $response = $this->put(route('matches.update', $match->id), [
      'team_1_id' => $teams[1]->id,
      'team_2_id' => $teams[2]->id,
      'match_date' => '2024-08-19',
    ]);

    $response->assertRedirect(route('matches.index'));
    $this->assertDatabaseHas('matches', [
      'id' => $match->id,
      'team_1_id' => $teams[1]->id,
      'team_2_id' => $teams[2]->id,
      'match_date' => '2024-08-19',
    ]);
  }

  /** @test */
  public function it_can_delete_a_match()
  {
    $match = Matches::factory()->create();

    $response = $this->delete(route('matches.destroy', $match->id));

    $response->assertRedirect(route('matches.index'));
    $this->assertDatabaseMissing('matches', [
      'id' => $match->id,
    ]);
  }

  /** @test */
  public function it_can_show_a_match()
  {
    $teams = Team::factory()->count(2)->create();
    $match = Matches::factory()->create([
      'team_1_id' => $teams[0]->id,
      'team_2_id' => $teams[1]->id,
      'match_date' => '2024-08-18',
    ]);

    $response = $this->get(route('matches.show', $match->id));

    $response->assertOk();
    $response->assertSee($teams[0]->name);
    $response->assertSee($teams[1]->name);
    $response->assertSee('2024-08-18');
  }

  /** @test */
  public function it_loads_the_edit_form_correctly()
  {
    $teams = Team::factory()->count(3)->create();
    $match = Matches::factory()->create([
      'team_1_id' => $teams[0]->id,
      'team_2_id' => $teams[1]->id,
      'match_date' => '2024-08-18',
    ]);

    $response = $this->get(route('matches.edit', $match->id));

    $response->assertOk();
    $response->assertSee($teams[0]->name);
    $response->assertSee($teams[1]->name);
    $response->assertSee('2024-08-18');
  }
}
