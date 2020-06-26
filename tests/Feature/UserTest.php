<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Church;
use App\User;

class UserTest extends TestCase
{
  use RefreshDatabase;

  protected $response;
  protected $church;
	
  protected function setUp(): void
  {
    parent::setUp();
    
    $this->church = factory(Church::class)->create();
    $this->response = $this->post(route('users.store'), [
      'name' => 'Test Name',
      'email' => 'email@example.com',
      'password' => 'password',
      'church_id' => $this->church->id
    ]);
      

  }


  public function test_a_user_can_be_added_through_the_form()
  {
    $user = User::find(1);
    $this->assertEquals('Test Name', $user->name);
  }

  public function test_redirects_to_index_after_submit()
  {
    $this->response->assertRedirect(route('users.index'));
  }

  public function test_success_message_in_session()
  {
	  $this->response->assertSessionHas('success', __('messages.add_success', ['item' => 'user']));
  }

  public function test_name_is_required()
  {
    $response = $this->post(route('users.store'), [
      'email' => 'email@example.com',
      'password' => 'password',
    ]);

    $response->assertSessionHasErrors('name');
	}

  public function test_email_is_required()
  {
    $response = $this->post(route('users.store'), [
      'name' => 'Test Name',
      'password' => 'password',
    ]);

    $response->assertSessionHasErrors('email');
  }

  public function test_email_must_be_a_valid_email()
  {
    $response = $this->post(route('users.store'), [
      'name' => 'Test Name',
      'email' => 'email',
      'password' => 'password'
    ]);

    $response->assertSessionHasErrors('email');
  }
  
  public function test_password_is_required()
  {
    $response = $this->post(route('users.store'), [
      'name' => 'Test Name',
      'email' => 'email@example.com',
    ]);

    $response->assertSessionHasErrors('password');
  }
  
  public function test_password_has_min_8_chars()
  {
    $response = $this->post(route('users.store'), [
      'name' => 'Test Name',
      'email' => 'email',
      'password' => 'pass'
    ]);

    $response->assertSessionHasErrors('password');
  }

  public function test_user_belongs_to_church(){
    $user = User::find(1);
    $this->assertEquals($this->church->name, $user->church->name);
  }

  public function test_church_has_multiple_users(){
    $user_count = 2;
    $church = factory(Church::class)->create();
    $users = factory(User::class, $user_count)->create(['church_id' => $church->id]);
    $this->assertCount($user_count, $church->users);
  }

  public function test_user_page_receives_all_churches(){
    $response = $this->get(route('users.create'));
    $response->assertViewHas('churches', Church::all());
  }

  public function test_users_can_view_signup_page()
  {
    $response = $this->get(route('users.create'));
    $response->assertStatus(200);
  }
}
