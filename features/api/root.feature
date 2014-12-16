Feature: Root page
  In order to see all books
  As a regular user
  I need to go to the root page

  Scenario: Confirm root page
    Given I send a GET request to "/books"
    Then I should see "Yaraku's Books"