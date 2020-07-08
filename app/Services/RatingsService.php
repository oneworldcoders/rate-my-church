<?php

namespace App\Services;

use App\QuestionUser;
  
class RatingsService {

  public function updateRatings($user, $questions, $request, $model)
  {
    foreach($questions as $question)
    {
      $model::create(['user_id' => $user->id, 'question_id' => $question->id, 'rating' => $request->input($question->id)]);
    }
  }
}
