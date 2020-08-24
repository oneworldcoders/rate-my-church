<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    protected $fillable = ['name', 'religion_id', 'overall_average'];

    public function address()
    {
      return $this->hasOne(Address::class);
    }

    public function religion()
    {
      return $this->belongsTo(Religion::class);
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
