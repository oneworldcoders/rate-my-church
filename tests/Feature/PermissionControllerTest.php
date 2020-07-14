<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\User;
use App\Role;

class PermissionControllerTest extends TestCase
{
  use RefreshDatabase;

  protected $admin;
  protected $user;
  protected $role;

  protected function setUp(): void
  {
    parent::setUp();
    $this->admin = factory(User::class)->create(['is_admin' => 1]);
    $this->user = factory(User::class)->create();
    $this->role = factory(Role::class)->create();
  }

  public function test_permission_index_view_is_rendered()
  {
    $response = $this->get(route('permissions.index'));
    $response->assertViewIs('permission.index');
  }

  public function test_permission_index_has_users()
  {
    $users = factory(User::class, 3)->create();
    $response = $this->get(route('permissions.index'));
    $response->assertViewHas('users');
  }

  public function test_permission_create_view_is_rendered()
  {
    $response = $this->get(route('permissions.create'));
    $response->assertViewIs('permission.create');
  }

  public function test_permission_create_has_users()
  {
    $users = factory(User::class, 3)->create();
    $response = $this->get(route('permissions.create'));
    $response->assertViewHas('users');
  }

  public function test_permission_create_has_roles()
  {
    $roles = factory(Role::class, 3)->create();
    $response = $this->get(route('permissions.create'));
    $response->assertViewHas('roles');
  }

  public function test_unauthenticated_users_cannot_assign_permission()
  {
    $user = factory(User::class)->create();
    $role = factory(Role::class)->create();
    $response = $this->post(route('permissions.store', [
      'user' => $user->id,
      'role' => $role->id,
    ]));
    $response->assertForbidden();
  }

  public function test_users_without_permission_cannot_assign_permission()
  {
    $user = factory(User::class)->create();
    $role = factory(Role::class)->create();
    $response = $this->actingAs($user)->post(route('permissions.store', [
      'user' => $user->id,
      'role' => $role->id,
    ]));
    $response->assertForbidden();
  }

  public function test_users_with_permission_can_assign_permission()
  {
    $user = factory(User::class)->create();
    $can_assign = Role::create(['name'=>'assign_roles', 'description'=>'']);
    $user->roles()->attach($can_assign);

    $role = factory(Role::class)->create();
    $response = $this->actingAs($user)->post(route('permissions.store', [
      'user' => $user->id,
      'role' => $role->id,
    ]));
    $this->assertCount(2, User::find($user->id)->roles);
  }


  public function test_permission_store_reates_user_role()
  {
    $response = $this->actingAs($this->admin)->post(route('permissions.store', [
      'user' => $this->user->id,
      'role' => $this->role->id,
    ]));
    $this->assertCount(1, User::find($this->user->id)->roles);
  }

  public function test_permission_store_has_success_message()
  {
    $response = $this->actingAs($this->admin)->post(route('permissions.store', [
      'user' => $this->user->id,
      'role' => $this->role->id,
    ]));
    $response->assertSessionHas('success', __('messages.add_success', ['item' => 'permission']));
  }

  public function test_permission_store_redirects_to_index()
  {
    $response = $this->actingAs($this->admin)->post(route('permissions.store', [
      'user' => $this->user->id,
      'role' => $this->role->id,
    ]));
    $response->assertRedirect(route('permissions.index'));
  }
}
