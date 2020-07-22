<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Presenters\ChartPresenter;

class ChartPresenterTest extends TestCase
{

  protected $mock;
  protected $response;

  public function setUp(): void
  {
    parent::setUp();

    $this->mock = $this->getMockForTrait(ChartPresenter::class);
    $this->response = $this->mock->build();
  }

  public function test_has_a_build_method()
  {
    $this->assertNotNull($this->mock->build());
  }

  public function test_return_object_contains_chart()
  {
    $this->assertNotNull($this->response['chart']);
  }

  public function test_chart_contains_labels()
  {
    $this->assertNotNull($this->response['chart']['labels']);
  }

  public function test_return_object_contains_datasets()
  {
    $this->assertNotNull($this->response['datasets']);
  }

  public function test_datasets_contains_name()
  {
    $this->assertNotNull($this->response['datasets'][0]['name']);
  }

  public function test_datasets_contains_values()
  {
    $this->assertNotNull($this->response['datasets'][0]['values']);
  }

  public function test_sets_datasetName()
  {
    $datasetName = 'Test Name';
    $this->response = $this->mock->build($datasetName);
    $this->assertEquals($this->response['datasets'][0]['name'], $datasetName);
  }

  public function test_sets_values()
  {
    $values = [1, 2];
    $this->response = $this->mock->build(null, $values);
    $this->assertEquals($this->response['datasets'][0]['values'], $values);
  }

  public function test_sets_labels_from_1_to_maxScore()
  {
    $maxScore = 3;
    $expectedLabels = [1, 2, 3];
    $this->response = $this->mock->build(null, null, $maxScore);
    $this->assertEquals($this->response['chart']['labels'], $expectedLabels);
  }
}
