<?php

use Illuminate\Database\Seeder;
use \App\User;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(User::class)->create(['name' => 'Admin', 'email' => 'admin@example.com', 'is_admin' => 1]);
    factory(User::class, 3)->create();
  }
}
