<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ResultController extends Controller
{
  public function index()
  {
    $results = Result::with('match')->get();
    return Inertia::render('Results/Index', ['results' => $results]);
  }

  public function create()
  {
    return Inertia::render('Results/Create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'matches_id' => 'required',
      'team_1_score' => 'required',
      'team_2_score' => 'required',
    ]);

    $match = new Result();
    $match->matches_id = $request->matches_id;
    $match->team_1_score = $request->team_1_score;
    $match->team_2_score = $request->team_2_score;
    $match->save();

    return Redirect::route('results.index')->with('success', 'Result created successfully.');
  }

  public function show(Result $result)
  {
    return Inertia::render('Results/Show', ['result' => $result]);
  }

  public function edit(Result $result)
  {
    return Inertia::render('Results/Edit', ['result' => $result]);
  }

  public function update(Request $request, Result $result)
  {
    $request->validate([
      'team_1_score' => 'required',
      'team_2_score' => 'required',
    ]);

    $result->team_1_id = $request->team_1_score;
    $result->team_2_id = $request->team_2_score;
    $result->save();

    return Redirect::route('Results.index')->with('success', 'Result updated successfully.');
  }

  public function destroy(Result $result)
  {
    $result->delete();
    return Redirect::route('results.index')->with('success', 'Result deleted successfully.');
  }
}
