<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Religion;
use App\Church;
use App\Address;

class ReligionPresenterTest extends TestCase
{
  use RefreshDatabase;

  protected $religions;
  protected $churches;
  protected $religion_1_churches;
  protected $religion_2_churches;

  public function setUp(): void
  {
    parent::setUp();
    $this->religions = factory(Religion::class, 2)->create();
    $this->churches = collect();

    $this->religion_1_churches = factory(Church::class, 2)->create(['religion_id' => $this->religions->first()]);
    $this->religion_2_churches = factory(Church::class, 2)->create(['religion_id' => $this->religions->last()]);
    $this->churches = array_merge($this->religion_1_churches->toArray(), $this->religion_2_churches->toArray());
  }
  
  public function test_get_church_names_attribute_returns_names_of_all_churches_in_religion()
  {
    $response = $this->religions->first()->church_names;
    $expected = [$this->religion_1_churches->first()->name, $this->religion_1_churches->last()->name];
    $this->assertEquals($response, $expected);
  }
  
  public function test_get_church_averages_attribute_returns_average_ratings_of_all_churches_in_religion()
  {
    $response = $this->religions->first()->church_averages;
    $expected = [$this->religion_1_churches->first()->overall_average, $this->religion_1_churches->last()->overall_average];
    $this->assertEquals($response, $expected);
  }
  
  public function test_get_church_ids_attribute_returns_ids_of_all_churches_in_religion()
  {
    $response = $this->religions->first()->church_ids;
    $expected = [$this->religion_1_churches->first()->id, $this->religion_1_churches->last()->id];
    $this->assertEquals($response, $expected);
  }
  
  public function test_get_church_addresses_attribute_returns_addresses_of_all_churches_in_religion()
  {
    $response = $this->religions->first()->church_addresses;
    $expected = [$this->religion_1_churches->first()->address, $this->religion_1_churches->last()->address];
    $this->assertEquals($response, $expected);
  }

  public function test_array_flatten_flattens_array()
  {
    $array = [[1, 2], [3, 4]];
    $expected = [1, 2, 3, 4];
    $response = Religion::array_flatten($array);
    $this->assertEquals($response, $expected);
  }

  public function test_all_church_ids_returns_all_ids_for_all_religions()
  {
    $response = Religion::all_church_ids($this->religions);
    $expected = [$this->churches[0]['id'], $this->churches[1]['id'], $this->churches[2]['id'], $this->churches[3]['id']];
    $this->assertEquals($response, $expected);
  }
  
  public function test_all_overall_averages_ids_returns_all_church_averages_for_all_religions()
  {
    $response = Religion::all_overall_averages($this->religions);
    $expected = [$this->churches[0]['overall_average'], $this->churches[1]['overall_average'], $this->churches[2]['overall_average'], $this->churches[3]['overall_average']];
    $this->assertEquals($response, $expected);
  }

  public function test_all_church_addresses_returns_all_church_addresses_for_all_religions()
  {
    $response = Religion::all_church_addresses($this->religions);
    $expected = [
      $this->religion_1_churches->first()->address,
      $this->religion_1_churches->last()->address,
      $this->religion_2_churches->first()->address,
      $this->religion_2_churches->last()->address
    ];
    $this->assertEquals($response, $expected);
  }
  
  public function test_all_church_names_returns_all_church_names_for_all_religions()
  {
    $response = Religion::all_church_names($this->religions);
    $expected = [$this->churches[0]['name'], $this->churches[1]['name'], $this->churches[2]['name'], $this->churches[3]['name']];
    $this->assertEquals($response, $expected);
  }

}
