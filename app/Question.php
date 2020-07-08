<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
  protected $guarded = [];

  public function church()
  {
    return $this->belongsTo(Church::class);
  }

 // public function users()
 // {
 //   return $this->belongsToMany(User::class)
 //               ->withPivot('rating')
 //               ->using(QuestionUser::class);
 // }

  public function ratings()
  {
    return $this->hasMany(QuestionUser::class);
  }
}
