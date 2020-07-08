<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\User;
use App\Question;

class RatingControllerTest extends TestCase
{
  use RefreshDatabase;

  protected $user;
  protected $church;
  protected $question;
  protected $get_response;
  protected $post_response;
  protected $rating;

  protected function setUp(): void
  {
    parent::setUp();
    $this->user = factory(User::class)->create();
    $this->church = $this->user->church;
    $this->question = factory(Question::class)->create(['church_id' => $this->church]);
    $this->get_response = $this->actingAs($this->user)->get(route('ratings.create'));

    $this->rating = 1;
    $this->post_response = $this->actingAs($this->user)->post(route('ratings.store'), [
      $this->question->id.'' => $this->rating,
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
    $this->assertEquals($this->rating, $this->user->ratings->find($this->question->id)->rating);
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
 
  public function test_ratings_page_receives_ratings()
  {
    $question = factory(Question::class)->create(['church_id' => $this->church->id]);
    $response = $this->get(route('ratings.show', $question));
    $response->assertViewHas('ratings', $question->ratings);
  }

}
