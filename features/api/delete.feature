Feature: Delete a book
  In order to delete a book
  As a regular user
  I need to click the delete button

  Scenario: Deleting a book
    Given that a book with id "1" exists
    When I send a GET request to "/books/1/delete"
    Then that book shouldn't be found anymore