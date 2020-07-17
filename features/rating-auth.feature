Feature: Rating Authentication
  Scenario: Cannot rate a church without permission
    Given I am a user with permission: 'not_rate_questions'
    When I visit the page: '/ratings/create'
    Then I get a response: 403
   
  Scenario: Can rate a chuch with permission
    Given I am a user with permission: 'rate_questions'
    When I visit the page: '/ratings/create'
    Then I get a response: 200
