<?php

namespace App\Policies;

use App\RoleUser;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoleUserPolicy
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
    return $this->canAssignRoles($user);
  }

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\User  $user
   * @param  \App\RoleUser  $roleUser
   * @return mixed
   */
  public function view(User $user, RoleUser $roleUser)
  {
    return $this->canAssignRoles($user);
  }

  public function save(User $user)
  {
    return $this->canAssignRoles($user);
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
   * @param  \App\RoleUser  $roleUser
   * @return mixed
   */
  public function update(User $user, RoleUser $roleUser)
  {
    //
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\User  $user
   * @param  \App\RoleUser  $roleUser
   * @return mixed
   */
  public function delete(User $user, RoleUser $roleUser)
  {
    //
  }

  /**
   * Determine whether the user can restore the model.
   *
   * @param  \App\User  $user
   * @param  \App\RoleUser  $roleUser
   * @return mixed
   */
  public function restore(User $user, RoleUser $roleUser)
  {
    //
  }

  /**
   * Determine whether the user can permanently delete the model.
   *
   * @param  \App\User  $user
   * @param  \App\RoleUser  $roleUser
   * @return mixed
   */
  public function forceDelete(User $user, RoleUser $roleUser)
  {
    //
  }

  protected function canAssignRoles(User $user)
  {
    return in_array('Assign Roles', $user->roles->pluck('name')->all()) || $user->is_admin;
  }
}
