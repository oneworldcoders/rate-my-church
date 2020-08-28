<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Church;
use App\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('admin_auth')->only(['destroy']);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->authorize('viewAny', Question::class);
    $questions = Question::all();
    return view('question.index', compact('questions'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $this->authorize('create', Question::class);
    return view('question.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(QuestionRequest $request)
  {
    $this->authorize('create', Question::class);
    $question = Question::create($request->all());
    return redirect()->route('questions.index')
                     ->with('success', __('messages.add_success', ['item' => 'question']));
  }

  /**
   * Display the specified resource.
   *
   * @param  Question  $question
   * @return \Illuminate\Http\Response
   */
  public function show(Question $question)
  {
    $this->authorize('view', $question, Question::class);
    return view('question.show', compact('question'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Question $question)
  {
    $church = $question->church;
    $question->delete();
    return redirect()->route('questions.index')
                     ->with(['success' =>  __('messages.delete_success', ['item' => 'question'])]);
  }
}
