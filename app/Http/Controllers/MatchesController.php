<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class MatchesController extends Controller
{
  public function index()
  {
    $matches = Matches::with(['team1', 'team2', 'result'])->get();
    return Inertia::render('Matches/Index', ['matches' => $matches]);
  }

  public function create()
  {
    return Inertia::render('Matches/Create');
  }

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

  public function show(Matches $match)
  {
    return Inertia::render('Matches/Show', ['match' => $match]);
  }

  public function edit(Matches $match)
  {
    return Inertia::render('Matches/Edit', ['match' => $match]);
  }

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

  public function destroy(Matches $match)
  {
    $match->delete();
    return Redirect::route('match.index')->with('success', 'Match deleted successfully.');
  }
}
