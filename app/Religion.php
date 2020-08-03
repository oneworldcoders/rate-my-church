<?php

namespace App;

use App\Presenters\ReligionPresenter;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
  use ReligionPresenter;

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
