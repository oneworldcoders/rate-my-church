<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Religion;
use App\User;

class UserTest extends TestCase
{
  use RefreshDatabase;

  protected $religion;
	
  protected function setUp(): void
  {
    parent::setUp();
    
    $this->religion = factory(Religion::class)->create();
  }

  public function test_register_page_receives_all_religions(){
    $response = $this->get(route('register'));
    $response->assertViewHas('religions', Religion::all());
  }

  public function test_users_can_view_signup_page()
  {
    $response = $this->get(route('register'));
    $response->assertStatus(200);
  }
}
