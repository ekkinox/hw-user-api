# Homework User API

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ekkinox/hw-user-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ekkinox/hw-user-api/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/ekkinox/hw-user-api/badges/build.png?b=master)](https://scrutinizer-ci.com/g/ekkinox/hw-user-api/build-status/master)

User API homework, by candidate [Jonathan VUILLEMIN](mailto:ekkinox@gmail.com).

## To read before starting

Technical stack details:
- [PHP >= 7.1](http://php.net/supported-versions.php)
- [Symfony 4 & flex](https://symfony.com/)
- [Behat](http://behat.org/en/latest/)
- [Phpspec](http://www.phpspec.net/en/stable/)
- [Phpunit](https://phpunit.de/)

Implementation details:
- The **user id has the same value as his login**
    - since the source files did not provided ids, but unique logins could be used
- Used **BBD approach** ([behat](features) + [phpspec](spec)) to specify domain objects
- Used **ADR pattern**:
    - [Actions](src/Action) (callables not ContainerAware),
    - [Domain](src/Domain) business logic (extractable),
    - [Responder](src/Responder) (reusable, domain agnostic)
- Concerning **flexibility / generalisation**:
    - the files path and default format (json) are stored as [settings](config/packages/parameters.yaml)
    - used the [symfony/serializer](https://symfony.com/doc/current/components/serializer.html) component to deserialize the source files
        - this serializer can support many other format (custom ones can be added)
    - if we would go from database or webservice source, created domain interfaces
        - `UserInterface`: to open custom implementations
        - `UserCollectionInterface`: to be hydrated from anywhere / anyhow with `UserInterface` implementations

Did not have time to:
- apply proper content negociation (Accept header & 406 http code)
- apply hypermedia type (ex: json-ld, hydra, etc)
- use Behat + Mink for behavior tests

## API specifications

### OpenAPI

You can find OpenAPI specification for the api in the [openapi/openapi.yml](openapi/openapi.yml) file.

Note: you can use the [swagger online editor](https://editor.swagger.io) tool to browse it.

### Examples

User details example:
```
[GET]http://localhost:8000/v1/users/fosterabigail
```
This endpoint will get the user with id (login) **fosterabigail**.

User list example:
```
[GET]http://localhost:8000/v1/users?login=foster&offset=0&limit=5
```
This endpoint will list the **first 5 users**, with their login containing **'foster'**.

## Usage

### Installation

With composer:
```
$ composer install
```
Note: forced to set composer `"minimum-stability": "dev"` on purpose (behat vs sf4 [issue](https://github.com/Behat/Behat/issues/1174))

### With build-in web server

You can run the api using symfony build-in server:
```
$ bin/console server:run 8000
```
Note: The api will be running on the port 8000.

### With docker

You can also run shipped docker php fpm container:
```
$ docker-compose up -d
```
Note: The api will be running on the port 8000.

## Tests

### BDD to specify the domain

Behat features & contexts can be found in [features](features) folder.

You can run Behat tests with:
```
$ vendor/bin/behat
```

Phpspec specifications can be found in [spec](spec) folder.

You can run Phpspec tests with:
```
$ vendor/bin/phpspec run
```

### Phpunit for testing the api

Unit, integration and functional tests of the api can be found in [tests](tests) folder.

You can run Phpunit tests with:
```
$ vendor/bin/phpunit
```