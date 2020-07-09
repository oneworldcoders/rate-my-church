<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
// use Laracasts\Presenter\PresentableTrait;

use App\Presenters\RatingPresenter;

class Rating extends Model
{
  use RatingPresenter;

  protected $guarded = [];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function question()
  {
    return $this->belongsTo(Question::class);
  }

}
