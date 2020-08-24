<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\ChurchQuestionPresenter;

class ChurchQuestion extends Model
{
  use ChurchQuestionPresenter;

  public $guarded = [];

  public function ratings()
  {
    return $this->hasMany(Rating::class);
  }

  public function church()
  {
    return $this->belongsTo(Church::class);
  }

  public function question()
  {
    return $this->belongsTo(Question::class)->withTrashed();
  }

  public function survey()
  {
    return $this->belongsTo(Survey::class);
  }
}
