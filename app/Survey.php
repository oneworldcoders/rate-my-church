<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Survey extends Model
{
  use SoftDeletes;

  protected $fillable = ['name'];

  public function questions()
  {
    return $this->belongsToMany(Question::class);
  }

  public function ratings()
  {
    return $this->hasMany(Rating::class);
  }

  public function church_questions()
  {
    return $this->hasMany(ChurchQuestion::class);
  }
}
