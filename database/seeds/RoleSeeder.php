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
    Role::create(['name'=>'assign_roles', 'description'=>'give users roles']);
    Role::create(['name'=>'rate_questions', 'description'=>'rate questions']);
    Role::create(['name'=>'view_churches', 'description'=>'view churches']);
    Role::create(['name'=>'add_questions', 'description'=>'add questions']);
  }
}
