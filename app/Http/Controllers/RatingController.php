<?php

namespace App\Http\Controllers;

use App\Rating;
use App\ChurchQuestion;
use App\Church;
use App\Survey;
use App\Services\RatingsService;
use App\Charts\RatingBarChart;

use Illuminate\Http\Request;

class RatingController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('admin_auth')->only(['view_responses']);
  }

  public function index(Request $request)
  {
    $this->authorize('viewAny', Rating::class);
    $user = auth()->user();
    $church = Church::find($request->church);
    $church_name = $church->name;
    $ratings = $user->ratings;
    return view('users.ratings.index', compact('church_name', 'ratings'));
  }

  public function create(Request $request)
  {
    $this->authorize('create', Rating::class);
    $church = Church::find($request->church);
    $survey = Survey::all()->last();
    return view('users.ratings.create', compact('church', 'survey'));
  }

  public function store(Request $request, RatingsService $service)
  {
    $this->authorize('create', Rating::class);
    $church_id = $request->church;
    $survey = Survey::find($request->survey);
    $user = auth()->user();
    $questions = $survey->questions;
    $data = $request->input();
    $service->updateRatings($user, $questions, $church_id, $survey, $data);
    return redirect()->route('churches.index')
                     ->with('success', __('messages.add_success', ['item' => 'ratings']));
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\ChurchQuestion  $rating
   * @return \Illuminate\Http\Response
   */
  public function show(ChurchQuestion $rating)
  {
    // 
  }

  public function view_responses(ChurchQuestion $church_question)
  {
    $rating_bar_chart = new RatingBarChart();
    $question = $church_question->question;
    $ratings = Rating::where('church_question_id', $church_question->id)->get();
    $church_name = $church_question->church->name;
    $chart_data = $rating_bar_chart->makeChart($ratings);

    return view('admin.question.show', compact('ratings', 'church_name', 'question', 'chart_data'));
  }
  
  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Rating  $rating
   * @return \Illuminate\Http\Response
   */
  public function edit(Rating $rating)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Rating  $rating
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Rating $rating)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Rating  $rating
   * @return \Illuminate\Http\Response
   */
  public function destroy(Rating $rating)
  {
    //
  }
}
