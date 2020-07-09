<?php

use Illuminate\Database\Seeder;

use \App\Question;
use \App\User;
use \App\Rating;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create();
        factory(Rating::class)->create(['user_id'=>$user, 'question_id'=>$question]);
    }
}
