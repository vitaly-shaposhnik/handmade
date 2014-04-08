Feature: Handmade
  In order to
  As authorized user
  I need to be able manage content

  @insulated @javascript @api
  Scenario: Enter handmade view page as user which has access to it
    Given I am on homepage
    When I go to "/admin"
    Then I should see "Login"
    When I fill in "Username" with "admin"
    And I fill in "Password" with "111111"
    And I check "Remember me"
    And I press "_submit"
    Then I should see "Sonata Admin"
    Then I should sleep "5000"