<?php

namespace App;

use App\Presenters\ReligionPresenter;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
  use ReligionPresenter;

  protected $guarded = [];

  public function users()
  {
    return $this->hasMany(User::class);
  }
  
  public function churches()
  {
    return $this->hasMany(Church::class);
  }
}
