<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
  use SoftDeletes;

  protected $guarded = [];

  public function church()
  {
    return $this->belongsTo(Church::class);
  }

  public function ratings()
  {
    return $this->hasMany(Rating::class);
  }
}
