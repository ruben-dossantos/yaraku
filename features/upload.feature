Feature: Upload a file
  In order to import books
  As a regular user
  I need to upload a CSV file

  Scenario: Uploading a CSV file
    Given that I visit "/books"
    When I choose to upload a CSV file
    And the file is uploaded
    Then "Ensaio sobre a cegueira" should exist

  Scenario: Uploading a file with unexpected data
    Given that I visit "/books"
    When I choose to upload a file with unexpected data
    And the file is uploaded
    Then the error message "Bad file! It is supposed to be a csv with id;title;author" should be shown
