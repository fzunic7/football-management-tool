<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ResultController extends Controller
{
  /**
   * Display a listing of the results.
   *
   * @return \Inertia\Response
   */
  public function index()
  {
    $results = Result::with('match')->get();

    return Inertia::render('Results/Index', ['results' => $results]);
  }

  /**
   * Show the form for creating a new result.
   *
   * @return \Inertia\Response
   */
  public function create()
  {
    return Inertia::render('Results/Create');
  }

  /**
   * Store a newly created result in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(Request $request)
  {
    $request->validate([
      'matches_id' => 'required',
      'team_1_score' => 'required',
      'team_2_score' => 'required',
    ]);

    $result = new Result();
    $result->matches_id = $request->matches_id;
    $result->team_1_score = $request->team_1_score;
    $result->team_2_score = $request->team_2_score;
    $result->save();

    return Redirect::route('results.index')->with('success', 'Result created successfully.');
  }

  /**
   * Display the specified result.
   *
   * @param  \App\Models\Result  $result
   * @return \Inertia\Response
   */
  public function show(Result $result)
  {
    return Inertia::render('Results/Show', ['result' => $result]);
  }

  /**
   * Show the form for editing the specified result.
   *
   * @param  \App\Models\Result  $result
   * @return \Inertia\Response
   */
  public function edit(Result $result)
  {
    return Inertia::render('Results/Edit', ['result' => $result]);
  }

  /**
   * Update the specified result in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Result  $result
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(Request $request, Result $result)
  {
    $request->validate([
      'team_1_score' => 'required',
      'team_2_score' => 'required',
    ]);

    $result->team_1_score = $request->team_1_score;
    $result->team_2_score = $request->team_2_score;
    $result->save();

    return Redirect::route('results.index')->with('success', 'Result updated successfully.');
  }

  /**
   * Remove the specified result from storage.
   *
   * @param  \App\Models\Result  $result
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy(Result $result)
  {
    $result->delete();

    return Redirect::route('results.index')->with('success', 'Result deleted successfully.');
  }
}
