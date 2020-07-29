<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Church;

class AddressSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(Faker $faker)
  {
    $churches = Church::all();
    foreach($churches as $church)
    {
      $church->address()->create(['fullname' => $faker->word, 'lat' => -1 * rand(10000, 30000)/10000, 'lng' => rand(290000, 310000)/10000]);
    }
  }
}
