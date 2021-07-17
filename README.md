# Documentation

## 1. Configuration

* Copy the .env.example file and name the copied file as : "_.env_"
* Replace all the default values by your actual database information as following :
    * "_DB_HOST_" : URL or IP where your database is located, example for local : "127.0.0.1"
    * "_DB_PORT_" : Port which is listening, for example by default : "3306"
    * "_DB_DATABASE_" : Name of your database
    * "_DB_USERNAME_" : Username to log in
    * "_DB_PASSWORD_" : Password to log in
* Open a command prompt in the project and launch the following command to get the dependencies (it is required to have "_Composer_" installed on your computer) : 
```bash
  composer install
```

## 2. Use
### Launch the API on local

Open a command prompt in the project and launch the following command to launch a server on local (it is required to have "_PHP-cli_" installed on your computer) :
```bash
php -S localhost:8000 -t ./public
```

### API Key

To contact the API, you need to provide for each call the API Key with a query parameter.

It is possible thanks to the middleware "_ApiKeyAuthMiddleware.php_".

The Api Key by default is "**ApiKeyExample**".

### Routes

List of routes available :
* List the items : "**/api/items**", method GET
* Show a specific item with ID : "**/api/items/ID**", method GET
* Create an item : "**/api/items**", method POST, must provide JSON data
* Update a specific item with ID : "**/api/items/ID**", method PUT, possibility to provide JSON data
* Delete a specific item with ID : "**/api/items/ID**", method DELETE

***

# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

## Contributing

Thank you for considering contributing to Lumen! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
