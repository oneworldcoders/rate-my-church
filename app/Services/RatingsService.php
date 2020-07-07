<?php

namespace App\Services;

class RatingsService {

  public function updateRatings($request)
  {
    $user = auth()->user();
    $questions = $user->church->questions;
    foreach($questions as $question)
    {
      $user->questions()->attach($question, ['rating' => $request->input($question->id)]);
    }
  }
}