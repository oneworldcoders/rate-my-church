<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Question;
use App\Rating;
use App\Services\RatingsService;
use App\Charts\RatingBarChart;

class RatingController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('admin_auth')->only(['show']);
  }

  public function index()
  {
    $this->authorize('viewAny', Rating::class);
    $user = auth()->user();
    $church_name = $user->church->name;
    $ratings = $user->ratings;
    return view('users.ratings.index', compact('church_name', 'ratings'));
  }

  public function create()
  {
    $this->authorize('create', Rating::class);
    $user = auth()->user();
    $church_name = $user->church->name;
    $questions = $user->church->questions;
    return view('users.ratings.create', compact('church_name', 'questions'));
  }

  public function store(Request $request, RatingsService $service)
  {
    echo 'here';

    $this->authorize('create', Rating::class);
    $user = auth()->user();
    $questions = $user->church->questions;
    $data = $request->input();
    $model = new Rating;
    $service->updateRatings($user, $questions, $data, $model);
    echo 'here';
    return redirect()->action('HomeController@index')
                     ->with('success', __('messages.add_success', ['item' => 'ratings']));
  }

  public function show($question_id, RatingBarChart $rating_bar_chart)
  {
    $question = Question::find($question_id);
    $ratings = $question->ratings;
    $church_name = $question->church->name;
    $chart_data = $rating_bar_chart->makeChart($ratings);

    return view('admin.question.show', compact('ratings', 'church_name', 'question', 'chart_data'));
  }
}
