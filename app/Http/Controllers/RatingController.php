<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Question;

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
        $ratings = $user->questions;
        return view('users.ratings.index', compact('church_name', 'ratings'));
    }

    public function create()
    {
        $user = auth()->user();
        $church_name = $user->church->name;
        $questions = $user->church->questions;
        return view('users.ratings.create', compact('church_name', 'questions'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $questions = $user->church->questions;

        foreach($questions as $question)
        {
            $user->questions()->attach($question, ['rating' => $request->input($question->id)]);
        }
        return redirect()->action('HomeController@index')
                         ->with('success', __('messages.add_success', ['item' => 'ratings']));
    }
}
