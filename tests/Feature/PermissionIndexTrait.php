<?php

namespace Tests\Feature;

trait PermissionIndexTrait
{
  public function test_forbid_user_without_permission_to_view_index()
  {
    $response = $this->actingAs($this->user)->get($this->index_route);
    $response->assertForbidden();
  }

  public function test_grants_user_with_view_permission_to_view_index()
  {
    $this->user->roles()->attach($this->view_role);
    $response = $this->actingAs($this->user)->get($this->index_route);
    $response->assertStatus(200);
  }

  public function test_grants_admin_to_view_index()
  {
    $response = $this->actingAs($this->admin)->get($this->index_route);
    $response->assertStatus(200);
  }
}

