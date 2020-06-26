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
        factory(Church::class, 3)->create();
    }
}
