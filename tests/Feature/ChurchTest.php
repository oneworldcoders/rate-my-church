<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Church;
use App\User;

class ChurchTest extends TestCase
{
	use RefreshDatabase;

  protected $response;
  protected $admin;
  protected $church_id;
	
	protected function setUp(): void
	{
		parent::setUp();
    $this->admin = factory(User::class)->create(['is_admin' => 1]);
    $this->response = $this->actingAs($this->admin)->post(route('churches.store'), [
      'id' => $this->church_id,
	    'name' => 'Test Name',
	    'location' => 'Test Location',
	    'religion' => 'Test Religion'
		]);
  }

  public function test_non_admin_get_redirected_to_home()
  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user)->get(route('churches.index'));
    $response->assertRedirect(route('home'));
  }

  public function test_a_church_can_be_added_through_the_form()
  {
    $church = Church::find(['id' => $this->church_id]);
		$this->assertNotNull($church);
  }

	public function test_redirects_to_index_after_submit()
	{
		$this->response->assertRedirect(route('churches.index'));
	}

  public function test_success_message_in_session()
  {
		$this->response->assertSessionHas('success', __('messages.add_success', ['item' => 'church']));
	}

	public function test_produces_error_with_a_missing_field()
  {
		$response = $this->post(route('churches.store'), [
	    'name' => 'Test Name',
	    'religion' => 'Religion'
		]);

		$response->assertSessionHasErrors('location');
	}

	public function test_church_name_uniqueness()
	{
		$response = $this->post(route('churches.store'), [
	    'name' => 'Test Name',
	    'location' => 'Location',
	    'religion' => 'Religion'
		]);

		$this->response->assertSessionHasErrors('name');
	}

	public function test_users_can_view_the_create_church_page()
	{
		$response = $this->get('/churches/create');
		$response->assertStatus(200);
	}

	public function test_church_index_route_renders_church_index_view()
	{
		$response = $this->get(route('churches.index'));
		$response->assertViewIs('admin.church.index');
	}

	public function test_church_index_route_contains_all_churches()
	{
		$churches = factory(Church::class, 3)->create();
		$response = $this->get(route('churches.index'));
		$response->assertViewHas('churches');
	}

	public function test_church_show_route_renders_church_show_view()
	{
		$church = factory(Church::class)->create();
		$response = $this->get(route('churches.show', $church));
		$response->assertViewIs('admin.church.show');
	}

	public function test_church_show_route_contains_a_church()
	{
		$church = factory(Church::class)->create();
		$response = $this->get(route('churches.show', $church));
		$response->assertViewHas('church', $church);
	}
}
