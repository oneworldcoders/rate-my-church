<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Question;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->authorizeResource(Survey::class);
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $surveys = Survey::all();
    return view('survey.index', compact('surveys'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $questions = Question::all();
    return view('survey.create', compact('questions'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $survey = Survey::create($request->input());
    $questions = $request->input('questions');
    $survey->questions()->attach($questions);
    return redirect()->route('surveys.index')
                     ->with('success', __('messages.add_success', ['item' => 'survey']));
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Survey  $survey
   * @return \Illuminate\Http\Response
   */
  public function show(Survey $survey)
  {
    return view('survey.show', compact('survey'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Survey  $survey
   * @return \Illuminate\Http\Response
   */
  public function edit(Survey $survey)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Survey  $survey
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Survey $survey)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Survey  $survey
   * @return \Illuminate\Http\Response
   */
  public function destroy(Survey $survey)
  {
    $survey->delete();
    return redirect()->route('surveys.index')
                     ->with('success', __('messages.delete_success', ['item' => 'survey']));
  }
}
