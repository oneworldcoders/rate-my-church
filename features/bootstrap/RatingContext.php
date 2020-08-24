<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Tests\TestCase;
use App\User;
use App\Role;
use App\Question;
use App\Survey;
use App\Church;


/**
 * Defines application features from the specific context.
 */
class RatingContext extends TestCase implements Context
{
  use DatabaseMigrations;

  protected $content;
  protected $user;

  /**
   * Initializes context.
   *
   * Every scenario gets its own context instance.
   * You can also pass arbitrary arguments to the
   * context constructor through behat.yml.
   */
  public function __construct()
  {
    putenv('DB_CONNECTION=sqlite');
    putenv('DB_DATABASE=:memory:');
    parent::setUp();
  }

  /** @BeforeScenario */
  public function before(BeforeScenarioScope $scope)
  {
    $this->artisan('migrate');
  }
  /** @AfterScenario */
  public function after(AfterScenarioScope $scope)
  {
    $this->artisan('migrate:rollback');
  }

  /**
   * @Given I am a user with permission: :permission
   */
  public function iAmAUserWithPermission($permission)
  {
    $this->user = factory(User::class)->create();
    $role = factory(Role::class)->create(['name' => $permission]);
    $this->user->roles()->attach($role);
  }

  /**
   * @Given A survey exists
   */
  public function aSurveyExists()
  {
    factory(Survey::class)->create();
  }

  /**
   * @Given A church exists with id : :church_id
   */
  public function aChurchExistsWithId($church_id)
  {
    factory(Church::class)->create(['id' => $church_id]);
  }


  /**
   * @When I visit the page: :url
   */
  public function iVisitThePage($url)
  {
    $this->context = $this->actingAs($this->user)->get($url);
  }

  /**
   * @Then I get a response: :statusCode
   */
  public function iGetAResponse($statusCode)
  {
    $this->context->assertStatus((int)$statusCode);
  }
}
