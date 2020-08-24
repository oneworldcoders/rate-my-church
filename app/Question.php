<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
  use SoftDeletes;

  protected $guarded = [];

  public function ratings()
  {
    return $this->hasMany(Rating::class);
  }

  public function surveys()
  {
    return $this->belongsToMany(Survey::class);
  }

  public function church_questions()
  {
    return $this->hasMany(ChurchQuestion::class);
  }
}
