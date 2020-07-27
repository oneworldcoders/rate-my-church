<?php

use Illuminate\Database\Seeder;
use \App\Church;

class ChurchSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $church = Church::where(['name' => "Christ Embassy"])->get()->first();
    if(!$church){
      factory(Church::class)->create(['name' => 'Christ Embassy']);
    }
    factory(Church::class)->create();
  }
}
