<?php

namespace App\Policies;

use App\Church;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChurchPolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function viewAny(User $user)
  {
    return in_array('view_churches', $user->roles->pluck('name')->all()) || $user->is_admin;
  }

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\User  $user
   * @param  \App\Church  $church
   * @return mixed
   */
  public function view(User $user, Church $church)
  {
    //
  }

  /**
   * Determine whether the user can create models.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function create(User $user)
  {
    //
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\User  $user
   * @param  \App\Church  $church
   * @return mixed
   */
  public function update(User $user, Church $church)
  {
    //
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\User  $user
   * @param  \App\Church  $church
   * @return mixed
   */
  public function delete(User $user, Church $church)
  {
    //
  }

  /**
   * Determine whether the user can restore the model.
   *
   * @param  \App\User  $user
   * @param  \App\Church  $church
   * @return mixed
   */
  public function restore(User $user, Church $church)
  {
    //
  }

  /**
   * Determine whether the user can permanently delete the model.
   *
   * @param  \App\User  $user
   * @param  \App\Church  $church
   * @return mixed
   */
  public function forceDelete(User $user, Church $church)
  {
    //
  }
}