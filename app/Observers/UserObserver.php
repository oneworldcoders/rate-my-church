<?php

namespace App\Observers;

use App\User;
use App\Role;

class UserObserver
{
  /**
   * Handle the user "created" event.
   *
   * @param  \App\User  $user
   * @return void
   */
  public function created(User $user)
  {
    if($user->is_admin) return;
    $roles = Role::where(['name' => 'rate_questions'])->orWhere(['name' => 'view_churches'])->get();
    foreach($roles as $role){
      $user->roles()->attach($role);
    }
  }

  /**
   * Handle the user "updated" event.
   *
   * @param  \App\User  $user
   * @return void
   */
  public function updated(User $user)
  {
    //
  }

  /**
   * Handle the user "deleted" event.
   *
   * @param  \App\User  $user
   * @return void
   */
  public function deleted(User $user)
  {
    //
  }

  /**
   * Handle the user "restored" event.
   *
   * @param  \App\User  $user
   * @return void
   */
  public function restored(User $user)
  {
    //
  }

  /**
   * Handle the user "force deleted" event.
   *
   * @param  \App\User  $user
   * @return void
   */
  public function forceDeleted(User $user)
  {
    //
  }
}
