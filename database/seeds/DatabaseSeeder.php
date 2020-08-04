<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call(ReligionSeeder::class);
    $this->call(ChurchSeeder::class);
    $this->call(UserSeeder::class);
    $this->call(QuestionSeeder::class);
    $this->call(RoleSeeder::class);
    $this->call(PermissionSeeder::class);
    $this->call(RatingSeeder::class);
    $this->call(AddressSeeder::class);
  }
}
