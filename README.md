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
- Used **ADR pattern**:
    - [Actions](src/Action) (not ContainerAware),
    - [Domain](src/Domain) business logic (extractable),
    - [Responder](src/Responder) (reusable, domain agnostic)
- Used **BBD approach** ([behat](features) + [phpspec](spec)) to specify domain objects

## API specifications

### OpenAPI

You can find OpenAPI specification for the api in the [openapi/openapi.yml](openapi/openapi.yml) file.

Note: you can use the [swagger online editor](https://editor.swagger.io) tool to browse it.

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

### Behat

Behat features & contexts can be found in [features](features) folder.

You can run Behat tests with:
```
$ vendor/bin/behat
```

### Phpspec

Phpspec specifications can be found in [spec](spec) folder.

You can run Phpspec tests with:
```
$ vendor/bin/phpspec run
```

### Phpunit

Unit, integration and functional tests can be found in [tests](tests) folder.

You can run Phpunit tests with:
```
$ vendor/bin/phpunit
```