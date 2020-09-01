<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\User;
use App\Role;
use App\Survey;

class SurveyControllerTest extends TestCase
{

  use RefreshDatabase;
  use PermissionIndexTrait;

  protected $user;
  protected $admin;
  protected $index_route;
  protected $view_role;

  public function setUp(): void
  {
    parent::setUp();

    $this->admin = factory(User::class)->create(['is_admin' => 1]);
    $this->user = factory(User::class)->create();

    $this->index_route = route('surveys.index');
    $this->view_role = factory(Role::class)->create(['name' => 'view_surveys']);
  }

  protected function create_survey()
  {
    return $this->actingAs($this->admin)->post(route('surveys.store'), [
      'name' => 'Survey Name',
      'questoin_ids' => [1, 2, 3]
    ]);
  }

  public function test_a_survey_can_be_added_through_the_form()
  {
    $this->response = $this->create_survey(); 

    $survey = Survey::firstWhere(['name' => 'Survey Name']);
    $this->assertTrue($survey->exists);
  }

  public function test_redirects_to_index_after_submit()
  {
    $this->response = $this->create_survey(); 
    $this->response->assertRedirect(route('surveys.index'));
  }

  public function test_success_message_in_session()
  {
    $this->response = $this->create_survey(); 
    $this->response->assertSessionHas('success', __('messages.add_success', ['item' => 'survey']));
  }

  public function test_unauthenticated_users_cannot_view_the_create_survey_page()
  {
    $response = $this->get(route('surveys.create'));
    $response->assertRedirect('login');
  }

  public function test_users_without_permisison_cannot_view_the_create_survey_page()
  {
    $response = $this->actingAs($this->user)->get(route('surveys.create'));
    $response->assertForbidden();
  }
  
  public function test_users_with_create_survey_permission_can_view_the_create_survey_page()
  {
    $role = factory(Role::class)->create(['name' => 'create_surveys']);
    $this->user->roles()->attach($role->id);
    $response = $this->actingAs($this->user)->get(route('surveys.create'));
    $response->assertStatus(200);
  }

  public function test_survey_index_route_renders_survey_index_view()
  {
    $response = $this->actingAs($this->admin)->get(route('surveys.index'));
    $response->assertViewIs('survey.index');
  }

  public function test_survey_index_route_contains_all_surveys()
  {
    $response = $this->actingAs($this->admin)->get(route('surveys.index'));
    $response->assertViewHas('surveys');
  }

  public function test_survey_show_route_renders_survey_show_view()
  { 
    $survey = factory(Survey::class)->create();
    $response = $this->actingAs($this->admin)->get(route('surveys.show', $survey));
    $response->assertViewIs('survey.show');
  }

  public function test_survey_show_route_contains_a_survey()
  {
    $survey = factory(Survey::class)->create();
    $response = $this->actingAs($this->admin)->get(route('surveys.show', $survey));
    $response->assertViewHas('survey', $survey);
  }


}
