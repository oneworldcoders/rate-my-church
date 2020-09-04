<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Religion;
use App\Role;
use App\User;

class UserTest extends TestCase
{
  use RefreshDatabase;

  protected $religion;
  protected $rate_role;
  protected $church_role;
  protected $user;
	
  protected function setUp(): void
  {
    parent::setUp();

    $this->religion = factory(Religion::class)->create();
    $this->rate_role = factory(Role::class)->create(['name' =>'Rate Questions']);
    $this->church_role = factory(Role::class)->create(['name' =>'View Churches']);
    $this->user = factory(User::class)->create();
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

  public function test_user_has_permission_to_rate_by_default()
  {
    $this->assertTrue(in_array($this->rate_role->id, $this->user->roles->pluck('id')->all()));
  }

  public function test_user_has_permission_to_view_churches_by_default()
  {
    $this->assertTrue(in_array($this->church_role->id, $this->user->roles->pluck('id')->all()));
  }
}
