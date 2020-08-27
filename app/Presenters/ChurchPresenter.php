<?php

namespace App\Presenters;

trait ChurchPresenter {

  public static function all_overall_averages($churches)
  {
    return $churches->map(function($church){ return $church->overall_average; })->toArray();
  }

  public static function all_church_names($churches)
  {
    return $churches->map(function($church){ return $church->name; })->toArray();
  }

  public static function all_church_addresses($churches)
  {
    return $churches->map(function($church){ return $church->address; })->toArray();
  }

  public static function all_church_ids($churches)
  {
    return $churches->map(function($church){ return $church->id; })->toArray();
  }
}

