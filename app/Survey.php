<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
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
