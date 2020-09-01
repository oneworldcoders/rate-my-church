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
    factory(User::class)->create(['name' => 'Emmanuel Omona', 'email' => 'emmanuelomona@example.com']);
    factory(User::class)->create(['name' => 'Henry Okonkwo', 'email' => 'henryokonkwo@example.com']);
    //factory(User::class, 10)->create();
  }
}
