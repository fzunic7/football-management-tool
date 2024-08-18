<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class MatchesController extends Controller
{
  /**
   * Display a listing of the matches.
   *
   * @return \Inertia\Response
   */
  public function index()
  {
    $matches = Matches::with(['team1', 'team2', 'result'])->get();

    return Inertia::render('Matches/Index', ['matches' => $matches]);
  }

  /**
   * Show the form for creating a new match.
   *
   * @return \Inertia\Response
   */
  public function create()
  {
    return Inertia::render('Matches/Create');
  }

  /**
   * Store a newly created match in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(Request $request)
  {
    $request->validate([
      'team_1_id' => 'required',
      'team_2_id' => 'required',
      'match_date' => 'required'
    ]);

    $match = new Matches();
    $match->team_1_id = $request->team_1_id;
    $match->team_2_id = $request->team_2_id;
    $match->match_date = $request->match_date;
    $match->save();

    return Redirect::route('matches.index')->with('success', 'Match created successfully.');
  }

  /**
   * Display the specified match.
   *
   * @param  \App\Models\Matches  $match
   * @return \Inertia\Response
   */
  public function show(Matches $match)
  {
    return Inertia::render('Matches/Show', ['match' => $match]);
  }

  /**
   * Show the form for editing the specified match.
   *
   * @param  \App\Models\Matches  $match
   * @return \Inertia\Response
   */
  public function edit(Matches $match)
  {
    return Inertia::render('Matches/Edit', ['match' => $match]);
  }

  /**
   * Update the specified match in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Matches  $match
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(Request $request, Matches $match)
  {
    $request->validate([
      'team_1_id' => 'required',
      'team_2_id' => 'required',
      'match_date' => 'required'
    ]);

    $match->team_1_id = $request->team_1_id;
    $match->team_2_id = $request->team_2_id;
    $match->match_date = $request->match_date;
    $match->save();

    return Redirect::route('matches.index')->with('success', 'Match updated successfully.');
  }

  /**
   * Remove the specified match from storage.
   *
   * @param  \App\Models\Matches  $match
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy(Matches $match)
  {
    $match->delete();

    return Redirect::route('matches.index')->with('success', 'Match deleted successfully.');
  }
}
