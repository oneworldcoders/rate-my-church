<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Question;
use App\User;

class QuestionUserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_have_multiple_questions()
    {
        $user = factory(User::class)->create();
        $questions = factory(Question::class, 2)->create();

        foreach ($questions as $question)
        {
            $user->questions()->attach($question, ['rating' => 1]);
        }
        $this->assertCount(2, $user->questions);
    }

    public function test_question_can_have_multiple_users()
    {
        $question = factory(Question::class)->create();
        $users = factory(User::class, 2)->create();

        foreach ($users as $user)
        {
            $question->users()->attach($user, ['rating' => 1]);
        }
        $this->assertCount(2, $question->users);
    }
}
