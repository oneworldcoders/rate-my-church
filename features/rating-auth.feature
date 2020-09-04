Feature: Rating Authentication
  Scenario: Cannot rate a church without permission
    Given I am a user with permission: 'not_rate_questions'
    When I visit the page: '/ratings/create?church=1'
    Then I get a response: 403
   
  Scenario: Can rate a chuch with permission
    Given I am a user with permission: 'Rate Questions'
    And A survey exists
    And A church exists with id : 1
    When I visit the page: '/ratings/create?church=1'
    Then I get a response: 200
