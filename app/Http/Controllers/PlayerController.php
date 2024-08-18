<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PlayerController extends Controller
{
  /**
   * Display a listing of the players.
   *
   * @return \Inertia\Response
   */
  public function index()
  {
    $players = Player::with('team')->get();

    return Inertia::render('Players/Index', ['players' => $players]);
  }

  /**
   * Show the form for creating a new player.
   *
   * @return \Inertia\Response
   */
  public function create()
  {
    $teams = Team::all();

    return Inertia::render('Players/Create', ['teams' => $teams]);
  }

  /**
   * Store a newly created player in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required'
    ]);

    $player = new Player();
    $player->name = $request->name;
    $player->team_id = $request->team_id ?: null;
    $player->save();

    return Redirect::route('players.index')->with('success', 'Player created successfully.');
  }

  /**
   * Display the specified player.
   *
   * @param  \App\Models\Player  $player
   * @return \Inertia\Response
   */
  public function show(Player $player)
  {
    return Inertia::render('Players/Show', ['player' => $player]);
  }

  /**
   * Show the form for editing the specified player.
   *
   * @param  \App\Models\Player  $player
   * @return \Inertia\Response
   */
  public function edit(Player $player)
  {
    $teams = Team::all();

    return Inertia::render('Players/Edit', ['player' => $player, 'teams' => $teams]);
  }

  /**
   * Update the specified player in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Player  $player
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(Request $request, Player $player)
  {
    $request->validate([
      'name' => 'required',
    ]);

    $player->name = $request->name;
    $player->save();

    return Redirect::route('players.index')->with('success', 'Player updated successfully.');
  }

  /**
   * Remove the specified player from storage.
   *
   * @param  \App\Models\Player  $player
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy(Player $player)
  {
    $player->delete();

    return Redirect::route('players.index')->with('success', 'Player deleted successfully.');
  }
}
