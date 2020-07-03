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
        $this->call(ChurchSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(QuestionUserSeeder::class);
    }
}
