Feature:
  In order to manipulate a collection of users
  As a developer
  I want to have an user collection object handling my users

  Scenario: The user collection can be initialized empty
    When I construct an empty user collection
    Then the user collection has "0" users

  Scenario: The user collection can be initialized with users and can retrieve them
    When I construct an user collection with following business data:
      | login     | password | title | lastname | firstname | gender | email        | picture                        | address                           |
      | johndoe   | password | mr    | Doe      | John      | male   | john@doe.com | http://example.com/johndoe.jpg | 123 Some Street SomeVille 99999   |
      | janedoe   | drowssap | mrs   | Doe      | Jane      | female | jane@doe.com | http://example.com/janedoe.jpg | 123 Other Street OtherVille 11111 |
    Then the user collection has "2" users
    And the user form the user collection with id "johndoe" firstname is "John"
    And the user form the user collection with id "janedoe" firstname is "Jane"
    And the user form the user collection with id "invalid" cannot be found

  Scenario: The user collection can be initialized with users, can add some more and can retrieve them
    When I construct an user collection with following business data:
      | login     | password | title | lastname | firstname | gender | email        | picture                        | address                           |
      | johndoe   | password | mr    | Doe      | John      | male   | john@doe.com | http://example.com/johndoe.jpg | 123 Some Street SomeVille 99999   |
      | janedoe   | drowssap | mrs   | Doe      | Jane      | female | jane@doe.com | http://example.com/janedoe.jpg | 123 Other Street OtherVille 11111 |
    And I add an user to the user collection with following business data:
      | login     | foobar                        |
      | password  | wordpass                      |
      | title     | miss                          |
      | lastname  | Bar                           |
      | firstname | Foo                           |
      | gender    | female                        |
      | email     | foo@bar.com                   |
      | picture   | http://example.com/foobar.jpg |
      | address   | 123 Foo Street BarVille 77777 |
    Then the user collection has "3" users
    And the user form the user collection with id "johndoe" firstname is "John"
    And the user form the user collection with id "janedoe" firstname is "Jane"
    And the user form the user collection with id "foobar" firstname is "Foo"
    And the user form the user collection with id "invalid" cannot be found