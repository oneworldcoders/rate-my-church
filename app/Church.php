<?php

namespace App;

use App\Presenters\ChurchPresenter;
use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    use ChurchPresenter;

    protected $fillable = ['name', 'religion_id', 'overall_average'];
    protected $with = ['address'];

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
