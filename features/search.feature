Feature: Search for a book
  In order to easily find a book
  As a regular user
  I need to search for it's name

  Scenario: Searching for a book
    Given that I visit "/books"
    When I fill the search input box with "Adventures of Tom Sawyer"
    And it exists in the database
    Then a book with the name "Adventures of Tom Sawyer" should be shown