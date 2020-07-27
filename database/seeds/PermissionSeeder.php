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
    $role = Role::where(['name' => 'rate_questions'])->get()->first();
    $users = User::all();

    foreach($users as $user)
    {
      $user->roles()->sync($role);
    }
  }
}
