Feature: Page endpoint
  As a user
  I want test the user workflow

  Background:
    Given a list of page persisted

  Scenario: Create a new post
    When I send a "POST" on "api/v1/page" with:
    """
    {
      "site_id": "0195e8c4-ad5a-4303-a4f3-c4190b067671",
      "user_id": "147fbb70-d6df-4cbe-88fc-f6494ec05101",
      "content": "test_content"
    }
    """
    Then the response status code should be "202"
    And the JSON response should match:
    """
    {
        "page": {
            "id": "@uuid@",
            "status": "@integer@",
            "content": "test_content",
            "created_on": "@string@.isDateTime()",
            "user": {
                "id": "147fbb70-d6df-4cbe-88fc-f6494ec05101"
            },
            "site": {
                "id": "0195e8c4-ad5a-4303-a4f3-c4190b067671"
            }
        }
    }
    """

  Scenario: Get an existent page
    When I send a "GET" request on "api/v1/page/03c81538-ce87-40b1-910a-aed3035c19d1"
    Then the response status code should be "200"
    And the JSON response should match:
    """
    {
        "page": {
            "id": "03c81538-ce87-40b1-910a-aed3035c19d1",
            "status": "@integer@",
            "content": "@string@",
            "created_on": "@string@.isDateTime()",
            "user": {
                "id": "@uuid@"
            },
            "site": {
                "id": "@uuid@"
            }
        }
    }
    """

  Scenario: Try to get a page with invalid id
    When I send a "GET" request on "api/v1/page/199"
    Then the response status code should be "400"
    And the response message is 'Value "199" is not a valid UUID.'

  Scenario: Try to get a non existent page
    When I send a "GET" request on "api/v1/page/13ed82bf-c9ec-4591-aeda-1f455070ae4b"
    Then the response status code should be "404"
    And the response message is 'Page with id "13ed82bf-c9ec-4591-aeda-1f455070ae4b" not found'

  Scenario: Get filter page
    When I send a "GET" request on "api/v1/page" with params 'filter={"user":["147fbb70-d6df-4cbe-88fc-f6494ec05101"], "status":1}'
    Then the response status code should be "200"
    And the JSON response should match:
    """
    [
        {
            "id": "@uuid@",
            "status": 1,
            "content": "@string@",
            "created_on": "@string@.isDateTime()",
            "user": {
                "id": "147fbb70-d6df-4cbe-88fc-f6494ec05101"
            },
            "site": {
                "id": "@uuid@"
            }
        },
        {
            "id": "@uuid@",
            "status": 1,
            "content": "@string@",
            "created_on": "@string@.isDateTime()",
            "user": {
                "id": "147fbb70-d6df-4cbe-88fc-f6494ec05101"
            },
            "site": {
                "id": "@uuid@"
            }
        }
    ]
    """