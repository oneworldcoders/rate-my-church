<?php

namespace App\Observers;

use App\Rating;

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
    $question = $rating->question;
    $sum = 0.0;
    $ratings = $rating->where(['question_id'=>$question->id])->get();
    
    foreach($ratings as $rating){
      $sum += $rating->score;
    }
    $count = $ratings->count();
    $average = $sum/$count;
    $question->update(['average_rating' => $average]);
  }
}
