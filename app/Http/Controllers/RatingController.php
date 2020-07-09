<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Question;
use App\Rating;
use App\Services\RatingsService;

class RatingController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $user = auth()->user();
    $church_name = $user->church->name;
    $ratings = $user->ratings;
    return view('users.ratings.index', compact('church_name', 'ratings'));
  }

  public function create()
  {
    $user = auth()->user();
    $church_name = $user->church->name;
    $questions = $user->church->questions;
    return view('users.ratings.create', compact('church_name', 'questions'));
  }

  public function store(Request $request, RatingsService $service)
  {
    $user = auth()->user();
    $questions = $user->church->questions;
    $data = $request->input();
    $model = new Rating;
    $service->updateRatings($user, $questions, $data, $model);
    return redirect()->action('HomeController@index')
                     ->with('success', __('messages.add_success', ['item' => 'ratings']));
  }

  public function show($question_id)
  {
    $question = Question::find($question_id);
    $ratings = $question->ratings;
    $church_name = $question->church->name;

    return view('admin.question.show', compact('ratings', 'church_name', 'question'));
  }
}
