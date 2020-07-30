<?php

use Illuminate\Database\Seeder;

use \App\Religion;
use \App\User;
use \App\Church;

class ReligionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $religion_names = ['Christian', 'Jewish'];

    foreach($religion_names as $name)
    {
      factory(Religion::class)->create(['name' => $name]);
    }

  }
}
