<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Question;
use App\Rating;
use App\Church;
use App\Services\RatingsService;
use App\Charts\RatingBarChart;

class RatingController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('admin_auth')->only(['show']);
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
    $questions = $church->questions;
    return view('users.ratings.create', compact('church', 'questions'));
  }

  public function store(Request $request, RatingsService $service)
  {
    $this->authorize('create', Rating::class);
    $church = Church::find($request->church);
    $user = auth()->user();
    $questions = $church->questions;
    $data = $request->input();
    $model = new Rating;
    $service->updateRatings($user, $questions, $data, $model);
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
