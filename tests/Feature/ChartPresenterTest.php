<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Presenters\ChartPresenter;

class ChartPresenterTest extends TestCase
{
  public function test_has_a_build_method()
  {
    $mock = $this->getMockForTrait('ChartPresenter');
    $this->assertTrue($mock->build());
  }
}
