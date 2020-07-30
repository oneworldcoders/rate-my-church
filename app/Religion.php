<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
  protected $guarded = [];

  protected function users()
  {
    return $this->hasMany(User::class);
  }
  
  protected function churches()
  {
    return $this->hasMany(Church::class);
  }
}
