<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PlayerController extends Controller
{
  public function index()
  {
    $players = Player::with('team')->get();
    return Inertia::render('Players/Index', ['players' => $players]);
  }

  public function create()
  {
    return Inertia::render('Players/Create');
  }

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

  public function show(Player $player)
  {
    return Inertia::render('Players/Show', ['player' => $player]);
  }

  public function edit(Player $player)
  {
    return Inertia::render('Players/Edit', ['player' => $player]);
  }

  public function update(Request $request, Player $player)
  {
    $request->validate([
      'name' => 'required',
    ]);

    $player->name = $request->name;
    $player->save();

    return Redirect::route('players.index')->with('success', 'Player updated successfully.');
  }

  public function destroy(Player $player)
  {
    $player->delete();
    return Redirect::route('players.index')->with('success', 'Player deleted successfully.');
  }
}
