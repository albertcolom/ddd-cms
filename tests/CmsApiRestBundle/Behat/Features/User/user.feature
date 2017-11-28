Feature: User endpoint
  As a user
  I want test the user workflow

  Background:
    Given a list of user persisted

  Scenario: Create a new user
    Given the queue associated to "events" producer is empty
    When I send a "POST" on "api/v1/user" with:
    """
    {
      "name": "test_name",
      "email": "test@email.com"
    }
    """
    Then the response status code should be "202"
    And the JSON response should match:
    """
    {
        "user": {
            "id": "@uuid@",
            "name": "test_name",
            "email": "test@email.com",
            "created_on": "@string@.isDateTime()"
        }
    }
    """
    And the queue associated to "events" producer has messages should match:
    """
    [
        {
            "id": "@uuid@",
            "type": "UserWasCreated",
            "occurred_on": "@string@.isDateTime()",
            "user_id": "@uuid@",
            "name": "test_name",
            "email": "test@email.com"
        }
    ]
    """

  Scenario: Get an existent user
    When I send a "GET" request on "api/v1/user/147fbb70-d6df-4cbe-88fc-f6494ec05101"
    Then the response status code should be "200"
    And the JSON response should match:
    """
    {
        "user": {
            "id": "147fbb70-d6df-4cbe-88fc-f6494ec05101",
            "name": "@string@",
            "email": "@string@isEmail()",
            "created_on": "@string@.isDateTime()"
        }
    }
    """

  Scenario: Try to get a user with invalid id
    When I send a "GET" request on "api/v1/user/199"
    Then the response status code should be "400"
    And the response message is 'Value "199" is not a valid UUID.'

  Scenario: Try to get a non existent user
    When I send a "GET" request on "api/v1/user/03ed82bf-c9ec-4591-aeda-1f455070ae4b"
    Then the response status code should be "404"
    And the response message is 'User with id "03ed82bf-c9ec-4591-aeda-1f455070ae4b" not found'