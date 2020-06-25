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
    
}
