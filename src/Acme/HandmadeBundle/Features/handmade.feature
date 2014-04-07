Feature: Handmade
  In order to
  As authorized user
  I need to be able manage content

  @insulated @javascript @api
  Scenario: Enter handmade view page as user which has access to it
    Given I am on homepage
    When I go to "/admin"
    Then I should see "Login"
    When I follow "Go to the login page"
    Then I should see "Login"
    When I fill in "Username" with "admin"
    And I fill in "Password" with "123456"
    And I press "Login"
    Then I should see "Welcome"

  @insulated @javascript
  Scenario: Enter handmade view page as user which has access to it
    Given I am on homepage
    When I go to "/admin"
    Then I should see "Login"
    When I follow "Go to the login page"
    Then I should see "Login"
    When I fill in "Username" with "admin"
    And I fill in "Password" with "123456"
    And I press "Login"
    Then I should see "Welcome"
