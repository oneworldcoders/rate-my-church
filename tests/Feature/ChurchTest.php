<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Church;

class ChurchTest extends TestCase
{
	use RefreshDatabase;

	protected $response;
	
	protected function setUp(): void
	{
		parent::setUp();

		$this->response = $this->post(route('church.store'), [
	    'name' => 'Test Name',
	    'location' => 'Test Location',
	    'religion' => 'Test Religion'
		]);
	}


  public function test_a_church_can_be_added_through_the_form()
  {
		$this->assertCount(1, Church::all());
  }

	public function test_redirects_to_index_after_submit()
	{
		$this->response->assertRedirect(route('church.index'));
	}

  public function test_success_message_in_session()
  {
		$this->response->assertSessionHas('success', 'church added succesfully');
	}

	public function test_produces_error_with_a_missing_field()
  {
		$response = $this->post(route('church.store'), [
	    'name' => 'Test Name',
	    'religion' => 'Religion'
		]);

		$response->assertSessionHasErrors('location');
	}

	public function test_church_name_uniqueness()
  {
		$response = $this->post(route('church.store'), [
	    'name' => 'Test Name',
	    'location' => 'Location',
	    'religion' => 'Religion'
		]);

		$this->response->assertSessionHasErrors('name');
	}

	public function test_users_can_view_church_page()
	{
		$response = $this->get('/church');
		$response->assertStatus(200);
	}
}
