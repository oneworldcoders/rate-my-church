<?php

namespace App\Observers;

use App\ChurchQuestion;

class ChurchQuestionObserver
{
  /**
   * Handle the church question "created" event.
   *
   * @param  \App\ChurchQuestion  $churchQuestion
   * @return void
   */
  public function created(ChurchQuestion $churchQuestion)
  {
    //
  }

  /**
   * Handle the church question "updated" event.
   *
   * @param  \App\ChurchQuestion  $churchQuestion
   * @return void
   */
  public function updated(ChurchQuestion $churchQuestion)
  {
    $church = $churchQuestion->church;
    $survey = $churchQuestion->survey;
    $averages = $church->church_questions->where('survey_id', $survey->id)->pluck('average_rating')->all();
    $overall_average = array_sum($averages) / count($averages);
    $church->update(['overall_average' => $overall_average]);
  }

  /**
   * Handle the church question "deleted" event.
   *
   * @param  \App\ChurchQuestion  $churchQuestion
   * @return void
   */
  public function deleted(ChurchQuestion $churchQuestion)
  {
    //
  }

  /**
   * Handle the church question "restored" event.
   *
   * @param  \App\ChurchQuestion  $churchQuestion
   * @return void
   */
  public function restored(ChurchQuestion $churchQuestion)
  {
    //
  }

  /**
   * Handle the church question "force deleted" event.
   *
   * @param  \App\ChurchQuestion  $churchQuestion
   * @return void
   */
  public function forceDeleted(ChurchQuestion $churchQuestion)
  {
    //
  }
}
