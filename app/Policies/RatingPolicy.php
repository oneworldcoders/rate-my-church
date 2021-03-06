<?php

namespace App\Policies;

use App\Rating;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RatingPolicy
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
    return in_array('Rate Questions', $user->roles->pluck('name')->all());
  }

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\User  $user
   * @param  \App\Rating  $rating
   * @return mixed
   */
  public function view(User $user, Rating $rating)
  {
    //
  }

  public function viewResponses(User $user)
  {
    $role = \App\Role::firstWhere(['name' => 'View Responses']);
    if ($role)
      return \App\RoleUser::firstWhere(['user_id' => $user->id, 'role_id' => $role->id]) || $user->is_admin;
    else
      return $user->is_admin;
    //return in_array('View Responses', $user->roles->pluck('name')->all()) || $user->is_admin;
  }

  /**
   * Determine whether the user can create models.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function create(User $user)
  {
    return in_array('Rate Questions', $user->roles->pluck('name')->all());
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\User  $user
   * @param  \App\Rating  $rating
   * @return mixed
   */
  public function update(User $user, Rating $rating)
  {
    //
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\User  $user
   * @param  \App\Rating  $rating
   * @return mixed
   */
  public function delete(User $user, Rating $rating)
  {
    //
  }

  /**
   * Determine whether the user can restore the model.
   *
   * @param  \App\User  $user
   * @param  \App\Rating  $rating
   * @return mixed
   */
  public function restore(User $user, Rating $rating)
  {
    //
  }

  /**
   * Determine whether the user can permanently delete the model.
   *
   * @param  \App\User  $user
   * @param  \App\Rating  $rating
   * @return mixed
   */
  public function forceDelete(User $user, Rating $rating)
  {
    //
  }

  protected function hasRated(User $user)
  {
    return Rating::where(['user_id' => $user->id])->exists();
  }
}
