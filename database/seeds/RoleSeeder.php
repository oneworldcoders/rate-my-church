<?php

use Illuminate\Database\Seeder;

use \App\Role;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Role::create(['name'=>'Assign Roles', 'description'=>'give users roles']);
    Role::create(['name'=>'Rate Questions', 'description'=>'rate questions']);
    Role::create(['name'=>'View Churches', 'description'=>'view churches']);
    Role::create(['name'=>'Add Churches', 'description'=>'add churches']);
    Role::create(['name'=>'View Questions', 'description'=>'view questions']);
    Role::create(['name'=>'Add Questions', 'description'=>'add questions']);
    Role::create(['name'=>'View Responses', 'description'=>'view all the ratings of a church']);
  }
}
