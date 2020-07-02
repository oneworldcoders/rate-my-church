<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Church;
use App\User;

class UserTest extends TestCase
{
  use RefreshDatabase;

  protected $church;
	
  protected function setUp(): void
  {
    parent::setUp();
    
    $this->church = factory(Church::class)->create();
  }

  public function test_user_belongs_to_church(){
    $user = factory(User::class)->create(['church_id' => $this->church->id]);
    $this->assertEquals($this->church->name, $user->church->name);
  }

  public function test_church_has_multiple_users(){
    $user_count = 2;
    $users = factory(User::class, $user_count)->create(['church_id' => $this->church->id]);
    $this->assertCount($user_count, $this->church->users);
  }

  public function test_register_page_receives_all_churches(){
    $response = $this->get(route('register'));
    $response->assertViewHas('churches', Church::all());
  }

  public function test_users_can_view_signup_page()
  {
    $response = $this->get(route('register'));
    $response->assertStatus(200);
  }
}
