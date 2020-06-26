<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\User;

class HomeControllerTest extends TestCase
{
  public function test_home_page_redirects_to_login()
  {
    $response = $this->get(route('home'));
    $response->assertRedirect(route('login'));
  }

  public function test_logged_in_users_can_view_home_page()
  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user)->get(route('home'));
    $response->assertStatus(200);
  }

  public function test_user_in_passed_to_the_view()
  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user)->get(route('home'));
    $response->assertViewHas('user', $user);
  }
  
}
