<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleUser extends Pivot
{
  protected $fillable = ['role_id', 'user_id'];
}
