<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use App\Models\Result;
use App\Models\Team;
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
    return Inertia::render('Matches/Create', ['teams' => Team::all()]);
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
      'match_date' => 'required',
      'team_1_score' => 'required|integer',
      'team_2_score' => 'required|integer',
    ]);

    $match = new Matches();
    $match->team_1_id = $request->team_1_id;
    $match->team_2_id = $request->team_2_id;
    $match->match_date = $request->match_date;
    $match->save();

    $result = new Result();
    $result->matches_id = $match->id;
    $result->team_1_score = $request->team_1_score;
    $result->team_2_score = $request->team_2_score;
    $result->save();

    return Redirect::route('matches.index')->with('success', 'Match and result created successfully.');
  }


  /**
   * Display the specified match.
   *
   * @param  \App\Models\Matches  $match
   * @return \Inertia\Response
   */
  public function show(Matches $match)
  {
    $match = $match->load('team1', 'team2', 'result');

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
    $result = $match->result;

    return Inertia::render('Matches/Edit', [
      'match' => $match,
      'result' => $result,
      'teams' => Team::all()
    ]);
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
      'match_date' => 'required',
      'team_1_score' => 'required|integer',
      'team_2_score' => 'required|integer',
    ]);

    $match->team_1_id = $request->team_1_id;
    $match->team_2_id = $request->team_2_id;
    $match->match_date = $request->match_date;
    $match->save();

    $result = $match->result ?: new Result();
    $result->matches_id = $match->id;
    $result->team_1_score = $request->team_1_score;
    $result->team_2_score = $request->team_2_score;
    $result->save();

    return Redirect::route('matches.index')->with('success', 'Match and result updated successfully.');
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
