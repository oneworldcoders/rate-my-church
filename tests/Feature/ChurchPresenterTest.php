<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Church;

class ChurchPresenterTest extends TestCase
{
  use RefreshDatabase;

  protected $churches;
  protected $church_1;
  protected $church_2;

  public function setUp(): void
  {
    parent::setUp();
    $this->church_1 = factory(Church::class)->create();
    $this->church_2 = factory(Church::class)->create();
    $this->churches = collect([$this->church_1, $this->church_2]);
  }

  public function test_all_overall_averages_returns_list_of_church_averages()
  {
    $response = Church::all_overall_averages($this->churches);
    $expected = [$this->church_1->overall_average, $this->church_2->overall_average];
    $this->assertEquals($response, $expected);
  }

  public function test_all_church_names_returns_list_of_church_names()
  {
    $response = Church::all_church_names($this->churches);
    $expected = [$this->church_1->name, $this->church_2->name];
    $this->assertEquals($response, $expected);
  }

  public function test_all_church_addresses_returns_list_of_church_addresses()
  {
    $response = Church::all_church_addresses($this->churches);
    $expected = [$this->church_1->address, $this->church_2->address];
    $this->assertEquals($response, $expected);
  }

  public function test_all_church_ids_returns_list_of_church_ids()
  {
    $response = Church::all_church_ids($this->churches);
    $expected = [$this->church_1->id, $this->church_2->id];
    $this->assertEquals($response, $expected);
  }
}
