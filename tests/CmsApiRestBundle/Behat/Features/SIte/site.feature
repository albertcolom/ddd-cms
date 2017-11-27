Feature: Site endpoint
  As a user
  I want test the site workflow

  Background:
    Given a list of site persisted

  Scenario: Create a new site
    When I send a "POST" on "api/v1/site" with:
    """
    {
      "name": "test_name",
      "description": "test_description"
    }
    """
    Then the response status code should be "202"
    And the JSON response should match:
    """
    {
        "site": {
            "id": "@uuid@",
            "name": "test_name",
            "description": "test_description",
            "created_on": "@string@.isDateTime()"
        }
    }
    """

  Scenario: Get an existent site
    When I send a "GET" request on "api/v1/site/0195e8c4-ad5a-4303-a4f3-c4190b067671"
    Then the response status code should be "200"
    And the JSON response should match:
    """
    {
        "site": {
            "id": "0195e8c4-ad5a-4303-a4f3-c4190b067671",
            "name": "@string@",
            "description": "@string@",
            "created_on": "@string@.isDateTime()"
        }
    }
    """

  Scenario: Try to get a site with invalid id
    When I send a "GET" request on "api/v1/site/199"
    Then the response status code should be "400"
    And the response message is 'Value "199" is not a valid UUID.'

  Scenario: Try to get a non existent site
    When I send a "GET" request on "api/v1/site/13ed82bf-c9ec-4591-aeda-1f455070ae4b"
    Then the response status code should be "404"
    And the response message is 'Site with id "13ed82bf-c9ec-4591-aeda-1f455070ae4b" not found'