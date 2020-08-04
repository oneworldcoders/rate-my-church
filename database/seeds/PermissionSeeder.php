<?php

use Illuminate\Database\Seeder;
use \App\User;
use \App\Role;

class PermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $roles = Role::where(['name' => 'rate_questions'])->orWhere(['name' => 'view_churches'])->get();
    $users = User::all();

    foreach($users as $user){
      foreach($roles as $role){
        $user->roles()->sync($role);
      }
    }
  }
}
