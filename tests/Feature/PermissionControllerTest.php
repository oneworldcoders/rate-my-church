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

  public function test_permission_store_has_success_message()
  {
    $response = $this->actingAs($this->admin)->post(route('permissions.save', [
      'permissions' => [json_encode(['user_id' => $this->user->id, 'role_id' => $this->role->id, 'checked' => true])],
    ]));
    $response->assertSessionHas('success', __('messages.add_success', ['item' => 'permissions']));
  }

  public function test_permission_store_redirects_to_index()
  {
    $response = $this->actingAs($this->admin)->post(route('permissions.save', [
      'permissions' => [json_encode(['user_id' => $this->user->id, 'role_id' => $this->role->id, 'checked' => true])],
    ]));
    $response->assertRedirect(route('permissions.index'));
  }

  public function test_save_adds_role_for_checked_boxes()
  {
    $user = factory(User::class)->create();
    $role = factory(Role::class)->create();
    $this->actingAs($this->admin)->post(route('permissions.save', [
      'permissions' => [json_encode(['user_id' => $user->id, 'role_id' => $role->id, 'checked' => true])],
    ]));

    $user = User::find($user->id);
    $this->assertTrue(in_array($role->id, $user->roles->pluck('id')->toArray()));
  }

  public function test_save_adds_multiple_roles_for_checked_boxes()
  {
    $user = factory(User::class)->create();
    $role = factory(Role::class)->create();
    $role2 = factory(Role::class)->create();
    $this->actingAs($this->admin)->post(route('permissions.save', [
      'permissions' => [
        json_encode(['user_id' => $user->id, 'role_id' => $role->id, 'checked' => true]),
        json_encode(['user_id' => $user->id, 'role_id' => $role2->id, 'checked' => true])
      ],
    ]));

    $user = User::find($user->id);

    $this->assertTrue(in_array($role->id, $user->roles->pluck('id')->toArray()));
    $this->assertTrue(in_array($role2->id, $user->roles->pluck('id')->toArray()));
  }

  public function test_save_deletes_roles_for_unchecked_boxes()
  {
    $role = factory(Role::class)->create();
    $role2 = factory(Role::class)->create();
    $user = factory(User::class)->create();
    $user->roles()->attach($role);
    $user->roles()->attach($role2);
    
    $this->actingAs($this->admin)->post(route('permissions.save', [
      'permissions' => [
        json_encode(['user_id' => $user->id, 'role_id' => $role->id, 'checked' => false]),
        json_encode(['user_id' => $user->id, 'role_id' => $role2->id, 'checked' => false]),
      ],
    ]));

    $user = User::find($user->id);

    $this->assertFalse(in_array($role->id, $user->roles->pluck('id')->toArray()));
    $this->assertFalse(in_array($role2->id, $user->roles->pluck('id')->toArray()));
  }

  public function test_save_adds_and_deletes_roles_for_checked_and_unchecked_boxes()
  {
    $this->withoutexceptionhandling();
    $role = factory(Role::class)->create();
    $role2 = factory(Role::class)->create();
    $user = factory(User::class)->create();
    $user->roles()->attach($role);
    
    $this->actingAs($this->admin)->post(route('permissions.save', [
      'permissions' => [
        json_encode(['user_id' => $user->id, 'role_id' => $role->id, 'checked' => false]),
        json_encode(['user_id' => $user->id, 'role_id' => $role2->id, 'checked' => true]),
      ],
    ]));

    $user = User::find($user->id);

    $this->assertFalse(in_array($role->id, $user->roles->pluck('id')->toArray()));
    $this->assertTrue(in_array($role2->id, $user->roles->pluck('id')->toArray()));
  }
}
