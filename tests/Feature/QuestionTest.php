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
  use PermissionIndexTrait;

  protected $response;
  protected $church;
  protected $admin;
  protected $user;
  protected $view_role;
  protected $index_route;
  protected $question;

  protected function setUp(): void
  {
    parent::setUp();
    $this->admin = factory(User::class)->create(['is_admin' => 1]);
    $this->user = factory(User::class)->create();
    $this->church = factory(Church::class)->create();
    $this->question = factory(Question::class)->create();
    $this->view_role = factory(Role::class)->create(['name' => 'View Questions']);
    $this->index_route = route('questions.index');

    $this->response = $this->actingAs($this->admin)->post(route('questions.store'), [
      'title' => 'Test Title',
      'description' => 'Test Description',
      'type' => 'Test Type',
    ]);
  }

  public function test_users_without_permission_cannot_create_questions()
  {
    $response = $this->actingAs($this->user)->get(route('questions.create'));
    $response->assertForbidden();
  }

  public function test_users_with_permission_can_create_questions()
  {
    $role = Role::create(['name'=>'Add Questions', 'description'=>'']);
    $this->user->roles()->attach($role);
    $response = $this->actingAs($this->user)->get(route('questions.create'));
    $response->assertStatus(200);
  }

  public function test_grants_admin_to_create_questions()
  {
		$response = $this->actingAs($this->admin)->get(route('questions.create'));
		$response->assertStatus(200);
  }

  public function test_a_question_can_be_added_through_the_form()
  {
    $this->assertCount(2, Question::all());
  }

  public function test_redirects_to_the_question_index_page_after_submit()
  {
    $this->response->assertRedirect(route('questions.index'));
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
    ]);

    $response->assertSessionHasErrors('title');
	}

  public function test_description_is_required()
  {
    $response = $this->post(route('questions.store'), [
      'title' => 'Test Test',
      'type' => 'Test Type',
    ]);

    $response->assertSessionHasErrors('description');
  }
  
  public function test_type_is_required()
  {
    $response = $this->post(route('questions.store'), [
      'title' => 'Test Test',
      'description' => 'Test Description',
    ]);

    $response->assertSessionHasErrors('type');
  }

  public function test_users_can_view_question_create_page()
  {
    $response = $this->get(route('questions.create'));
    $response->assertStatus(200);
  }
 
  public function test_question_index_renders_question_index_view()
  {
    $response = $this->actingAs($this->admin)->get(route('questions.index', $this->question));
    $response->assertViewIs('question.index');
  }

  public function test_question_index_renders_all_questions()
  {
    $response = $this->actingAs($this->admin)->get(route('questions.index', $this->question));
    $response->assertViewHas('questions');
    $this->assertEquals($response['questions']->count(), Question::all()->count());
  }

  public function test_users_cannot_delete_questions()
  {
    $response = $this->actingAs($this->user)->delete(route('questions.destroy', $this->question));
    $this->assertTrue(Question::where(['id' => $this->question->id])->exists());
  }

  public function test_question_is_deleted()
  {
    $response = $this->actingAs($this->admin)->delete(route('questions.destroy', $this->question));
    $this->assertFalse(Question::where(['id'=> $this->question->id])->exists());
  }

  public function test_redirects_to_question_index_page_after_deleting()
  {
    $response = $this->actingAs($this->admin)->delete(route('questions.destroy', $this->question));
    $response->assertRedirect(route('questions.index'));
  }
 }
