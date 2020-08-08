Feature: Rating Authentication
  Scenario: Cannot rate a church without permission
    Given I am a user with permission: 'not_rate_questions'
    When I visit the page: '/ratings/create?church=1'
    Then I get a response: 403
   
  Scenario: Can rate a chuch with permission
    Given I am a user with permission: 'rate_questions'
    And A church has questions: '1'
    When I visit the page: '/ratings/create?church=1'
    Then I get a response: 200
