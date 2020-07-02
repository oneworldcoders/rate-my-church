<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\User;

class HomeControllerTest extends TestCase
{
  use RefreshDatabase;

  protected $user;
  protected $church;

  protected function setUp(): void
	{
		parent::setUp();
    $this->user = factory(User::class)->create();
    $this->church = $this->user->church;
  }
  
  public function test_home_page_redirects_to_login()
  {
    $response = $this->get(route('home'));
    $response->assertRedirect(route('login'));
  }

  public function test_logged_in_users_can_view_home_page()
  {
    $response = $this->actingAs($this->user)->get(route('home'));
    $response->assertStatus(200);
  }

}
