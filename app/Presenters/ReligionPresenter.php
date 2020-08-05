<?php

namespace App\Presenters;

trait ReligionPresenter {

  public static function all_church_names($religions)
  {
    return self::array_flatten($religions->map(function($religion){ return $religion->church_names; })->toArray());
  }

  public static function all_church_addresses($religions)
  {
    return self::array_flatten($religions->map(function($religion){ return $religion->church_addresses; })->toArray());
  }

  public static function all_overall_averages($religions)
  {
    return self::array_flatten($religions->map(function($religion){ return $religion->church_averages; })->toArray());
  }

  public static function all_church_ids($religions)
  {
    return self::array_flatten($religions->map(function($religion){ return $religion->church_ids; })->toArray());
  }

  public static function array_flatten($array) {
    if (!is_array($array)) {
      return false;
    }
    $result = array();
    foreach ($array as $key => $value) {
      if (is_array($value)) {
        $result = array_merge($result, self::array_flatten($value));
      } else {
        $result = array_merge($result, array($key => $value));
      }
    }
    return $result;
  }

  public function getChurchNamesAttribute()
  {
    $names = [];
    $churches = $this->churches;
    foreach($churches as $church){
      array_push($names, $church->name);
    }
    return $names;
  }
  
  public function getChurchAddressesAttribute()
  {
    $addresses = [];
    $churches = $this->churches;
    foreach($churches as $church){
      array_push($addresses, $church->address);
    }
    return $addresses;
  }

  public function getChurchAveragesAttribute()
  {
    $churches = $this->churches;
    return $churches->map(function($church){ return $church->overall_average; })->toArray();
  }

  public function getChurchIdsAttribute()
  {
    $churches = $this->churches;
    return $churches->map(function($church){ return $church->id; })->toArray();
  }

}
