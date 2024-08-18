<?php
namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TeamController extends Controller
{
  public function index()
  {
    $teams = Team::all();
    return Inertia::render('Teams/Index', ['teams' => $teams]);
  }

  public function create()
  {
    return Inertia::render('Teams/Create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required',
    ]);

    $team = new Team();
    $team->name = $request->name;
    $team->save();

    return Redirect::route('teams.index')->with('success', 'Team created successfully.');
  }

  public function show(Team $team)
  {
    return Inertia::render('Teams/Show', ['team' => $team]);
  }

  public function edit(Team $team)
  {
    return Inertia::render('Teams/Edit', ['team' => $team]);
  }

  public function update(Request $request, Team $team)
  {
    $request->validate([
      'name' => 'required',
    ]);

    $team->name = $request->name;
    $team->save();

    return Redirect::route('teams.index')->with('success', 'Team updated successfully.');
  }

  public function destroy(Team $team)
  {
    $team->delete();
    return Redirect::route('teams.index')->with('success', 'Team deleted successfully.');
  }
}