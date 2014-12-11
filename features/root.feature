Feature: Root page
  In order to see all books
  As a regular user
  I need to go to the root page

  Scenario: Confirm root page
    Given I visit "/"
    Then I should see "Yaraku's Books"