<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\User;
use App\Question;
use App\Rating;

class RatingControllerTest extends TestCase
{
  use RefreshDatabase;

  protected $user;
  protected $admin;
  protected $church;
  protected $question;
  protected $get_response;
  protected $post_response;
  protected $score;

  protected function setUp(): void
  {
    parent::setUp();
    $this->user = factory(User::class)->create();
    $this->admin = factory(User::class)->create(['is_admin' => 1]);
    $this->church = $this->user->church;
    $this->question = factory(Question::class)->create(['church_id' => $this->church]);
    $this->get_response = $this->actingAs($this->user)->get(route('ratings.create'));

    $this->score = 1;
    $this->post_response = $this->actingAs($this->user)->post(route('ratings.store'), [
      $this->question->id.'' => $this->score,
    ]);
  }

  public function test_church_name_in_passed_to_the_create_view()
  {
    $this->get_response->assertViewHas('church_name', $this->church->name);
  }

  public function test_questions_are_passed_to_the_create_view()
  {
    $this->get_response->assertViewHas('questions', $this->church->questions);
  }

  public function test_redirects_to_home_after_submit()
  {
    $this->post_response->assertRedirect(route('home'));
  }

  public function test_success_message_in_session()
  {
    $this->post_response->assertSessionHas('success', __('messages.add_success', ['item' => 'ratings']));
  }

  public function test_adds_ratings_for_a_question()
  {
    $this->assertEquals($this->score, $this->user->ratings->find($this->question->id)->score);
  } 

  public function test_user_can_view_response_page()
  {
    $response = $this->actingAs($this->user)->get(route('ratings.index'));
    $response->assertStatus(200);
  }

  public function test_response_page_contains_ratings()
  {
    $response = $this->actingAs($this->user)->get(route('ratings.index'));
    $response->assertViewHas('ratings', $this->user->questions);
  }

  public function test_response_page_contains_church_name()
  {
    $response = $this->actingAs($this->user)->get(route('ratings.index'));
    $response->assertViewHas('church_name', $this->church->name);
  }

  public function test_admin_can_view_ratings()
  {
    $response = $this->actingAs($this->admin)->get(route('ratings.show', $this->question));
    $response->assertStatus(200);
  }

  public function test_non_admin_get_redirected()
  {
    $response = $this->actingAs($this->user)->get(route('ratings.show', $this->question));
    $response->assertRedirect('home');
  }

  public function test_ratings_page_receives_ratings()
  {
    $ratings = $this->question->ratings;
    $response = $this->actingAs($this->admin)->get(route('ratings.show', $this->question));
    $response->assertViewHas('ratings');
  }

  public function test_average_rating_gets_updated()
  {
    $rating = Rating::find(['question_id'=>$this->question->id]);
    $updated_question = Question::find($this->question->id);
    $this->assertEquals($this->score, $updated_question->average_rating);
  }

}
