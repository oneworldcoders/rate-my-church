<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\User;
use App\Question;
use App\ChurchQuestion;
use App\Survey;
use App\Rating;
use App\Role;
use App\Church;

class RatingControllerTest extends TestCase
{
  use RefreshDatabase;

  protected $user;
  protected $unauthorized_user;
  protected $admin;
  protected $church;
  protected $question;
  protected $survey;
  protected $church_question;
  protected $create_response;
  protected $post_response;
  protected $index_response;
  protected $score;
  protected $view_responses_role;

  protected function setUp(): void
  {
    parent::setUp();
    $this->role = factory(Role::class)->create(['name' => 'Rate Questions']);
    $this->view_responses_role = factory(Role::class)->create(['name' => 'View Responses']);
    $this->user = factory(User::class)->create();
    
    $this->unauthorized_user = factory(User::class)->create();
    $this->remove_permission($this->unauthorized_user, $this->role);
    
    $this->admin = factory(User::class)->create(['is_admin' => 1]);
    $this->church = factory(Church::class)->create();
    $this->question = factory(Question::class)->create();

    $this->survey = factory(Survey::class)->create();
    $this->survey->questions()->attach([$this->question->id]);
    $this->church_question = ChurchQuestion::create(['church_id' => $this->church->id, 'question_id' => $this->question->id, 'survey_id' => $this->survey->id]);
    
    $this->score = 1;
    $this->post_response = $this->actingAs($this->user)->post(route('ratings.store'), [
      $this->question->id.'' => $this->score,
      'church' => $this->church->id,
      'survey' => $this->survey->id,
    ]);

    $this->create_response = $this->actingAs($this->user)->get(route('ratings.create', ['church' => $this->church]));
    $this->index_response = $this->actingAs($this->user)->get(route('ratings.index', ['church' => $this->church, 'survey' => $this->survey]));
  }

  protected function give_permissions($user, $role)
  {
    $user->roles()->attach($role);
  }

  protected function remove_permission($user, $role)
  {
    $user->roles()->detach($role);
  }

  public function test_unauthorized_users_cannot_view_ratings()
  {
    $response = $this->actingAs($this->unauthorized_user)->get(route('ratings.index'));
    $response->assertForbidden();
  }

  public function test_unauthorized_users_cannot_view_create_ratings_page()
  {
    $response = $this->actingAs($this->unauthorized_user)->get(route('ratings.create'));
    $response->assertForbidden();
  }

  public function test_unauthorized_users_cannot_store_ratings()
  {
    $response = $this->actingAs($this->unauthorized_user)->get(route('ratings.store'));
    $response->assertForbidden();
  }

  public function test_church_is_passed_to_the_create_view()
  {
    $this->create_response->assertViewHas('church', $this->church);
  }

  public function test_last_created_survey_is_passed_to_the_create_view()
  {
    $this->create_response->assertViewHas('survey', Survey::all()->last());
  }

  public function test_redirects_to_home_after_submit()
  {
    $this->post_response->assertRedirect(route('churches.index'));
  }

  public function test_success_rating_message_in_session()
  {
    Rating::truncate();
    $this->post_response = $this->actingAs($this->user)->post(route('ratings.store'), [
      $this->question->id.'' => $this->score,
      'church' => $this->church->id,
      'survey' => $this->survey->id,
    ]);
    $this->post_response->assertSessionHas('success', __('messages.add_success', ['item' => 'ratings']));
  }

  public function test_adds_ratings_for_a_question()
  {
    $this->assertEquals($this->score, $this->user->ratings->firstWhere('church_question_id', $this->church_question->id)->score);
  } 

  public function test_user_can_view_response_page()
  {
    $this->index_response->assertStatus(200);
  }

  public function test_response_page_contains_ratings()
  {
    $ratings = Rating::where(['user_id' => $this->user->id, 'church_question_id' => $this->church_question->id])->get();
    $this->index_response->assertViewHas('ratings');
    $this->assertEquals($this->index_response['ratings']->count(), $ratings->count());
  }

  public function test_response_page_contains_latest_ratings_even_with_survey_deleted()
  {
    $ratings = collect();
    $rating = Rating::where(['user_id' => $this->user->id, 'church_question_id' => $this->church_question->id])->get();
    $this->survey->delete(); 

    $index_response = $this->actingAs($this->user)->get(route('ratings.index', ['church' => $this->church, 'survey' => $this->survey->id]));
    $index_response->assertViewHas('ratings');
    $this->assertEquals($index_response['ratings']->count(), $rating->count());
  }

  public function test_response_page_contains_church_name()
  {
    $this->index_response->assertViewHas('church_name', $this->church->name);
  }

  public function test_ratings_index_receives_chart_data()
  {
    $this->index_response->assertViewHas('chart_data');
  }

  public function test_admin_can_view_ratings()
  {
    $response = $this->actingAs($this->admin)->get(route('ratings.view_responses', $this->church_question));
    $response->assertStatus(200);
  }

  public function test_users_without_permissions_cannot_view_responses()
  {
    $response = $this->actingAs($this->user)->get(route('ratings.view_responses', $this->church_question));
    $response->assertForbidden();
  }

  public function test_users_with_permissions_can_view_responses()
  {
    $this->user->roles()->attach($this->view_responses_role->id);
    $response = $this->actingAs($this->user)->get(route('ratings.view_responses', $this->church_question));
    $response->assertStatus(200);
  }

  public function test_ratings_page_receives_ratings()
  {
    $this->withoutExceptionHandling();
    $response = $this->actingAs($this->admin)->get(route('ratings.view_responses', $this->church_question));
    $response->assertViewHas('ratings');
  }

  public function test_average_rating_gets_updated()
  {
    $rating = Rating::find(['church_question_id'=>$this->church_question->id]);
    $updated_church_question = ChurchQuestion::find($this->church_question->id);
    $this->assertEquals($this->score, $updated_church_question->average_rating);
  }
}
