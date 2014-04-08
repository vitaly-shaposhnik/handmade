Feature: Handmade
  In order to
  As authorized user
  I need to be able manage content

  @insulated @javascript @api
  Scenario: Test admin page login
    Given I am on homepage
    When I go to "/admin"
    Then I should see "Login"
    When I fill in "Username" with "admin"
    And I fill in "Password" with "111111"
    And I check "Remember me"
    And I press "_submit"
    Then I should see "Sonata Admin"
    And I should sleep "3000"
    When I go to homepage
    Then I should see "Творим с любовью!"
    And I should sleep "3000"

    @insulated @javascript
    Scenario: Test feature
      Given I logged in as "admin" with "111111" password
      When I go to "/admin"
      Then I should see "Sonata Admin"
      And I should sleep "2000"