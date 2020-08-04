<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Church;
use App\User;
use App\Role;

class ChurchTest extends TestCase
{
  use RefreshDatabase;

  protected $response;
  protected $admin;
  protected $church;
  protected $full_address;

  protected function setUp(): void
  {
    parent::setUp();
    $this->admin = factory(User::class)->create(['is_admin' => 1]);
    $church_name = 'Test Name';
    $this->full_address = 'Full Address';
    $this->response = $this->actingAs($this->admin)->post(route('churches.store'), [
      'name' => $church_name,
      'religion' => 'Test Religion',
      'address' => [
        'fullname' => $this->full_address,
        'lat' => 0,
        'lng' => 0,
      ],
    ]);

    $this->church = Church::firstWhere(['name' => $church_name]);
  }

  public function test_forbid_non_admin_without_view_churches_role()
  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user)->get(route('churches.index'));
    $response->assertForbidden();
  }

  public function test_grants_non_admin_with_view_churches_role()
  {
    $user = factory(User::class)->create();
    $role = Role::create(['name'=>'view_churches', 'description'=>'']);
    $user->roles()->attach($role);
    $response = $this->actingAs($user)->get(route('churches.index'));
    $response->assertStatus(200);
  }

  public function test_grants_admin_to_view_churches()
  {
    $user = factory(User::class)->create(['is_admin' => 1]);
    $response = $this->actingAs($user)->get(route('churches.index'));
    $response->assertStatus(200);
  }

  public function test_a_church_can_be_added_through_the_form()
  {
    $this->assertTrue($this->church->exists);
  }

  public function test_address_is_created()
  {
    $this->assertTrue($this->church->address->exists);
  }
  
  public function test_address_is_with_attributes()
  {
    $address = $this->church->address;
    $this->assertEquals($address->fullname, $this->full_address);
  }

  public function test_redirects_to_index_after_submit()
  {
    $this->response->assertRedirect(route('churches.index'));
  }

  public function test_success_message_in_session()
  {
    $this->response->assertSessionHas('success', __('messages.add_success', ['item' => 'church']));
  }

  public function test_produces_error_with_a_missing_address()
  {
    $response = $this->post(route('churches.store'), [
      'name' => 'Test Name',
      'religion' => 'Religion'
    ]);

    $response->assertSessionHasErrors('address.fullname');
    $response->assertSessionHasErrors('address.lat');
    $response->assertSessionHasErrors('address.lng');
  }

  public function test_church_name_uniqueness()
  {
    $response = $this->post(route('churches.store'), [
      'name' => 'Test Name',
      'religion' => 'Religion',
      'address' => [
        'fullname' => 'Test FullName',
        'lat' => 0,
        'lng' => 0,
      ],
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
    $response = $this->get(route('churches.index'));
    $response->assertViewHas('churches');
  }

  public function test_church_index_route_contains_addresses()
  {
    $response = $this->get(route('churches.index'));
    $response->assertViewHas('addresses');
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
