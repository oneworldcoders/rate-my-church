<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Church;
use App\Question;

class QuestionTest extends TestCase
{
  use RefreshDatabase;

  protected $response;
	
  protected function setUp(): void
  {
    parent::setUp();

    $church_response = $this->post(route('churches.store'), [
      'id' => 1,
      'name' => 'Test Name',
      'location' => 'Test Location',
      'religion' => 'Test Religion'
    ]);
    
    $this->response = $this->post(route('questions.store'), [
      'title' => 'Test Title',
      'description' => 'Test Description',
      'type' => 'Test Type',
      'church_id' => 1
    ]);
  }


  public function test_a_question_can_be_added_through_the_form()
  {
    $this->assertCount(1, Question::all());
  }

  public function test_redirects_to_index_after_submit()
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
      'church_id' => 1
    ]);

    $response->assertSessionHasErrors('title');
	}

  public function test_description_is_required()
  {
    $response = $this->post(route('questions.store'), [
      'title' => 'Test Test',
      'type' => 'Test Type',
      'church_id' => 1
    ]);

    $response->assertSessionHasErrors('description');
  }
  
  public function test_type_is_required()
  {
    $response = $this->post(route('questions.store'), [
      'title' => 'Test Test',
      'description' => 'Test Description',
      'church_id' => 1
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
