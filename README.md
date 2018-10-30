# Homework User API

User API homework, by candidate [Jonathan VUILLEMIN](mailto:ekkinox@gmail.com).

## To read before starting

Technical stack:
- [PHP 7.2](http://php.net/supported-versions.php)
- [Sumfony 4 & flex](https://symfony.com/)
- [Behat](http://behat.org/en/latest/)
- [Phpspec](http://www.phpspec.net/en/stable/)
- [Phpunit](https://phpunit.de/)

Implementation:
- Used BBD approach (behat + phpspec) to define domain objects (classes, interfaces)

## API specifications

### OpenAPI

You can find OpenAPI specification describing the api in the [openapi/openapi.yml](openapi/openapi.yml) file.

Note: you can use the [swagger online editor](https://editor.swagger.io) tool to browse it.

## Usage

### Installation

With composer:
```
$ composer install
```

### With build-in web server

You can run the api using symfony build-in server:
```
$ bin/console server:run 8000
```
The api will be running on the port 8000.

### With docker

You can also run shipped docker php fpm container:
```
$ docker-compose up -d
```
The api will be running on the port 8000.

## Tests

### Behat

You can run Behat tests with:
```
$ vendor/bin/behat
```

### Phpspec

You can run Phpspec tests with:
```
$ vendor/bin/phpspec run
```

### Phpunit

You can run phpunit tests with:
```
$ bin/phpunit
```