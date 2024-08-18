<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TeamController extends Controller
{
  /**
   * Display a listing of the teams.
   *
   * @return \Inertia\Response
   */
  public function index()
  {
    $teams = Team::all();

    return Inertia::render('Teams/Index', ['teams' => $teams]);
  }

  /**
   * Show the form for creating a new team.
   *
   * @return \Inertia\Response
   */
  public function create()
  {
    return Inertia::render('Teams/Create');
  }

  /**
   * Store a newly created team in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   */
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

  /**
   * Display the specified team.
   *
   * @param  \App\Models\Team  $team
   * @return \Inertia\Response
   */
  public function show(Team $team)
  {
    return Inertia::render('Teams/Show', ['team' => $team]);
  }

  /**
   * Show the form for editing the specified team.
   *
   * @param  \App\Models\Team  $team
   * @return \Inertia\Response
   */
  public function edit(Team $team)
  {
    return Inertia::render('Teams/Edit', ['team' => $team]);
  }

  /**
   * Update the specified team in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Team  $team
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(Request $request, Team $team)
  {
    $request->validate([
      'name' => 'required',
    ]);

    $team->name = $request->name;
    $team->save();

    return Redirect::route('teams.index')->with('success', 'Team updated successfully.');
  }

  /**
   * Remove the specified team from storage.
   *
   * @param  \App\Models\Team  $team
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy(Team $team)
  {
    $team->delete();

    return Redirect::route('teams.index')->with('success', 'Team deleted successfully.');
  }
}
