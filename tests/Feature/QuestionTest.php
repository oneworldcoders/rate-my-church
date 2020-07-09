<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Church;
use App\Question;
use App\User;
use App\Role;

class QuestionTest extends TestCase
{
  use RefreshDatabase;

  protected $response;
  protected $church;
  protected $admin;

  protected function setUp(): void
  {
    parent::setUp();
    $this->admin = factory(User::class)->create(['is_admin' => 1]);
    $this->church = factory(Church::class)->create();
    $this->response = $this->actingAs($this->admin)->post(route('questions.store'), [
      'title' => 'Test Title',
      'description' => 'Test Description',
      'type' => 'Test Type',
      'church_id' => $this->church->id
    ]);
  }

  public function test_users_without_permission_cannot_create_questions()
  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user)->get(route('questions.create'));
    $response->assertForbidden();
  }

  public function test_users_with_permission_can_create_questions()
  {
    $user = factory(User::class)->create();
    $role = Role::create(['name'=>'add_questions', 'description'=>'']);
    $user->roles()->attach($role);
    $response = $this->actingAs($user)->get(route('questions.create'));
    $response->assertStatus(200);
  }

  public function test_grants_admin_to_create_questions()
  {
		$user = factory(User::class)->create(['is_admin' => 1]);
		$response = $this->actingAs($user)->get(route('questions.create'));
		$response->assertStatus(200);
  }

  public function test_a_question_can_be_added_through_the_form()
  {
    $this->assertCount(1, Question::all());
  }

  public function test_redirects_to_index_after_submit()
  {
    $this->response->assertRedirect(route('admin'));
  }

  public function test_success_message_in_session()
  {
	  $this->response->assertSessionHas('success', __('messages.add_success', ['item' => 'question']));
  }

  public function test_title_is_required()
  {
    $response = $this->post(route('questions.store'), [
      'description' => 'Test Description',
      'type' => 'Test Type',
      'church_id' => $this->church->id
    ]);

    $response->assertSessionHasErrors('title');
	}

  public function test_description_is_required()
  {
    $response = $this->post(route('questions.store'), [
      'title' => 'Test Test',
      'type' => 'Test Type',
      'church_id' => $this->church->id
    ]);

    $response->assertSessionHasErrors('description');
  }
  
  public function test_type_is_required()
  {
    $response = $this->post(route('questions.store'), [
      'title' => 'Test Test',
      'description' => 'Test Description',
      'church_id' => $this->church->id
    ]);

    $response->assertSessionHasErrors('type');
  }
  
  public function test_church_id_is_required()
  {
    $response = $this->post(route('questions.store'), [
      'title' => 'Test Test',
      'description' => 'Test Description',
      'type' => 'Test Type'
    ]);

    $response->assertSessionHasErrors('church_id');
  }

  public function test_questions_page_receives_churches(){
    $response = $this->get(route('questions.create'));
    $response->assertViewHas('churches', Church::all());
  }

  public function test_users_can_view_question_create_page()
  {
    $response = $this->get(route('questions.create'));
    $response->assertStatus(200);
  }

 }
