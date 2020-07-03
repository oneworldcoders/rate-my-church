<?php

namespace App\Services;

class RatingsService {

  public function updateRatings($user, $request)
  {
    $questions = $user->church->questions;
    foreach($questions as $question)
    {
      $user->questions()->attach($question, ['rating' => $request->input($question->id)]);
    }
  }
}
