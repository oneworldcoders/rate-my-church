<?php

namespace App\Services;

use App\ChurchQuestion;
use App\Rating;

class RatingsService {

  public function updateRatings($user, $questions, $church_id, $survey,  $data)
  {
    foreach($questions as $question)
    {
      $church_question = ChurchQuestion::firstWhere(['question_id' => $question->id, 'church_id' => $church_id, 'survey_id' => $survey->id]);
      Rating::create(['user_id' => $user->id, 'church_question_id' => $church_question->id, 'score' => $data[$question->id]]);
    }
  }
}
