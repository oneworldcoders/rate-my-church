<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    protected $table = 'church';
    protected $fillable = ['name', 'location', 'religion'];
}
