<?php

namespace App\Presenters;

trait RatingPresenter {

  public function getUserNameAttribute(): string
  {
      return $this->user->name;
  }

  public function getDescriptionAttribute(): string
  {
      return $this->church_question->question->description;
  }

  public function getQuestionAttribute()
  {
      return $this->church_question->question;
  }

  public function getChurchIdAttribute()
  {
      return $this->church_question->church->id;
  }

}
