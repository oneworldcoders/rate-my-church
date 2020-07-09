<?php

namespace App\Services;

class RatingsService {

  public function updateRatings($user, $questions, $data, $model)
  {
    foreach($questions as $question)
    {
      $model::create(['user_id' => $user->id, 'question_id' => $question->id, 'score' => $data[$question->id]]);
    }
  }
}
