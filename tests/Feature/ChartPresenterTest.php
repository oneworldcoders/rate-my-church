<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use JsonSchema\Validator;

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

  public function test_schema_is_valid()
  {
    $schema = json_decode(file_get_contents('tests/ChartData.json'));

    $validator = new Validator;
    $validator->validate($this->response, $schema);
    $this->assertTrue($validator->isValid());
  }

  public function test_sets_datasetName()
  {
    $datasetName = 'Test Name';
    $this->response = $this->mock->build($datasetName);
    $this->assertEquals($this->response['datasets'][0]['label'], $datasetName);
  }

  public function test_sets_values()
  {
    $values = [1, 2];
    $this->response = $this->mock->build(null, $values);
    $this->assertEquals($this->response['datasets'][0]['data'], $values);
  }

  public function test_sets_labels_from_1_to_maxScore()
  {
    $maxScore = 3;
    $expectedLabels = [1, 2, 3];
    $this->response = $this->mock->build(null, null, $maxScore);
    $this->assertEquals($this->response['labels'], $expectedLabels);
  }
}
