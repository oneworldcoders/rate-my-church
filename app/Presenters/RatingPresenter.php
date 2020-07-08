<?php

namespace App\Presenters;

trait RatingPresenter {

  public function getUserNameAttribute(): string
  {
      return $this->user->name;
  }

  public function getDescriptionAttribute(): string
  {
      return $this->question->description;
  }

}
