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

  public function test_admin_can_view_permission_index()
  {
    $response = $this->actingAs($this->admin)->get(route('permissions.index'));
    $response->assertStatus(200);
  }

  public function test_users_without_permission_cannot_view_permission_index()
  {
    $response = $this->actingAs($this->user)->get(route('permissions.index'));
    $response->assertForbidden();
  }
  
  public function test_with_permission_can_view_permission_index()
  {
    $role = factory(Role::class)->create(['name' => 'Assign Roles']);
    $this->user->roles()->attach($role);
    $response = $this->actingAs($this->user)->get(route('permissions.index'));
    $response->assertStatus(200);
  }

  public function test_permission_index_view_is_rendered()
  {
    $response = $this->actingAs($this->admin)->get(route('permissions.index'));
    $response->assertViewIs('permission.index');
  }

  public function test_permission_index_has_users()
  {
    $users = factory(User::class, 3)->create();
    $response = $this->actingAs($this->admin)->get(route('permissions.index'));
    $response->assertViewHas('users');
  }

  public function test_permission_search_by_username()
  {
    $response = $this->actingAs($this->admin)->get(route('permissions.index', ['name' => $this->user->name]));
    $response->assertViewHas('users');
    $this->assertEquals($this->user->id, $response['users']->first()->id);
  }

  public function test_permission_search_name_ignores_case()
  {
    $response = $this->actingAs($this->admin)->get(route('permissions.index', ['name' => strtolower($this->user->name)]));
    $response->assertViewHas('users');
    $this->assertEquals($this->user->id, $response['users']->first()->id);
  }

  public function test_permission_search_matches_incomplete_names()
  {
    $response = $this->actingAs($this->admin)->get(route('permissions.index', ['name' => substr($this->user->name, 0, 5)]));
    $response->assertViewHas('users');
    $this->assertEquals($this->user->id, $response['users']->first()->id);
  }

  public function test_permission_search_by_email()
  {
    $response = $this->actingAs($this->admin)->get(route('permissions.index', ['email' => $this->user->email]));
    $response->assertViewHas('users');
    $this->assertEquals($this->user->id, $response['users']->first()->id);
  }

  public function test_permission_search_email_ignores_case()
  {
    $user = factory(User::class)->create(['email' => 'Email@Example.com']);
    $response = $this->actingAs($this->admin)->get(route('permissions.index', ['email' => strtolower($user->email)]));
    $response->assertViewHas('users');
    $this->assertEquals($user->id, $response['users']->first()->id);
  }

  public function test_permission_search_matches_incomplete_emails()
  {
    $response = $this->actingAs($this->admin)->get(route('permissions.index', ['email' => substr($this->user->email, 0, 5)]));
    $response->assertViewHas('users');
    $this->assertEquals($this->user->id, $response['users']->first()->id);
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
