<?php

namespace App\Presenters;

trait ChurchQuestionPresenter {

  public function getQuestionTitleAttribute(): string
  {
    return $this->question->title;
  }

  public function getQuestionDescriptionAttribute(): string
  {
    return $this->question->description;
  }
}

