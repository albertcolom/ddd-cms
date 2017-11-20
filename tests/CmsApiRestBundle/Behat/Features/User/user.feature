Feature: User endpoint
  As a user
  I want test the user workflow

  Scenario: List the wallets
    When I send a "GET" request to "user/03ed82bf-c9ec-4591-aeda-1f455070ae4a"
    And the response code is "200"

  Scenario: Try to get a user with invalid id
    When I send a "GET" request to "user/xxxx-xxxx-xxx-xx"
    And the response code is "400"
    And the response message is 'Value "xxxx-xxxx-xxx-xx" is not a valid UUID.'

  Scenario: Try to get a non existent user
    When I send a "GET" request to "user/03ed82bf-c9ec-4591-aeda-1f455070ae4b"
    And the response code is "404"
    And the response message is 'User with id "03ed82bf-c9ec-4591-aeda-1f455070ae4b" not found'