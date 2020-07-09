<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\User;
use App\Role;

class RoleControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $index_response;
    protected $create_response;
    protected $store_response;

    protected function setUp(): void
    {
        parent::setUp();

        $post_data = array('name' => 'Test name', 'description' => 'description');

        $this->admin = factory(User::class)->create(['is_admin' => 1]);
        $this->index_response = $this->actingAs($this->admin)->get(route('roles.index'));
        $this->create_response = $this->actingAs($this->admin)->get(route('roles.create'));
        $this->store_response = $this->actingAs($this->admin)->post(route('roles.store'), $post_data);
    }

    public function test_non_admin_users_get_have_no_access()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get(route('roles.index'));
        $response->assertRedirect('home');
    }

    public function test_admin_users_get_have_access()
    {
        $this->index_response->assertStatus(200);
    }

    public function test_index_route_renders_role_index_view()
    {
        $this->index_response->assertViewIs('role.index');
    }

    public function test_index_view_has_roles()
    {
        $this->index_response->assertViewHas('roles');
    }

    public function test_create_renders_create_view()
    {
        $this->create_response->assertViewIs('role.create');
    }

    public function test_store_redirects_to_index()
    {
        $this->store_response->assertRedirect(route('roles.index'));
    }

    public function test_store_has_success_message()
    {
        $this->store_response->assertSessionHas('success', __('messages.add_success', ['item' => 'role']));
    }

    public function test_store_creates_role()
    {
        $roles = Role::all();
        $this->assertCount(1, $roles);
    }

}
