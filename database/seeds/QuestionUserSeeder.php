<?php

use Illuminate\Database\Seeder;
use \App\Question;
use \App\User;

class QuestionUserSeeder extends Seeder
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
        $question->users()->attach($user, ['rating' => 1]);
    }
}

