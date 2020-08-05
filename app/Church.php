<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    protected $fillable = ['name', 'religion_id', 'overall_average'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function address()
    {
      return $this->hasOne(Address::class);
    }

    public function religion()
    {
      return $this->belongsTo(Religion::class);
    }
}
