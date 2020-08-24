<?php

namespace App\Observers;

use App\Rating;
use App\ChurchQuestion;

class RatingsObserver
{
  /**
   * Handle the question user "created" event.
   *
   * @param  \App\Rating  $rating
   * @return void
   */
  public function created(Rating $rating)
  {
    $church_question = $rating->church_question;
    $sum = 0.0;
    $ratings = $rating->where(['church_question_id' => $church_question->id])->get();
    
    foreach($ratings as $rating){
      $sum += $rating->score;
    }
    $count = $ratings->count();
    $average = $sum/$count;
    $church_question->update(['average_rating' => number_format((float)$average, 2)]);
  }
}
