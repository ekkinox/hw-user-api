Feature:
  In order to manipulate users business data
  As a developer
  I want to have an user object handling my users business data

  Scenario: The user object can handle and retrieve my user business data
    When I construct an user object with following business data:
      | login     | johndoe                         |
      | password  | password                        |
      | title     | mr                              |
      | lastname  | Doe                             |
      | firstname | John                            |
      | gender    | male                            |
      | email     | john@doe.com                    |
      | picture   | http://example.com/johndoe.jpg  |
      | address   | 123 Some Street SomeVille 99999 |
    Then the user object login must be "johndoe"
    Then the user object password must be "password"
    Then the user object title must be "mr"
    Then the user object lastname must be "Doe"
    Then the user object firstname must be "John"
    Then the user object gender must be "male"
    Then the user object email must be "john@doe.com"
    Then the user object picture must be "http://example.com/johndoe.jpg"
    Then the user object address must be "123 Some Street SomeVille 99999"
