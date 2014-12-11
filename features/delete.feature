Feature: Delete a book
  In order to delete a book
  As a regular user
  I need to click the delete button

  Scenario: Deleting a book
    Given that I visit "/books"
    When I click on delete book
    Then that book shouldn't exist anymore in the database