# Laravel Magento 2 Integration

This package provides a simple way to integrate a Laravel application with a Magento 2 website via the REST API. It can be used for anything from fetching basic product information to building a complete custom shopping experience backed by Magento.

**This project is in early development stages and does not yet support all functionality of the Magento API. Pull requests are welcome!**

# Installation

## Requirements

- PHP 7.1.3 or later
- Laravel 5.6 or later

## Setup

From your Laravel application, install the package via [composer](https://getcomposer.org) and publish the default configuration files.

```bash
composer require alanaktion/laravel-magento
php artisan vendor:publish
```

# Usage

## Connecting

Start by adding your Magento base URL (*e.g.* `https://www.example.com/`) to your configuration to your `.env` file as `MAGENTO_BASE_URL`. This URL must be accessible from your Laravel application's server.

Next, configure your API access:

- If your integration will be accessing non-public resources, create a new Integration following the [Magento documentation](http://devdocs.magento.com/guides/v2.2/get-started/authentication/gs-authentication-token.html) and add the Access Token to your `.env` file as `MAGENTO_TOKEN`.
- If you do not need to access non-public resources, or will only be doing so in some circumstances, make sure your Magento site is [configured to allow anonymous API access](http://devdocs.magento.com/guides/v2.2/rest/anonymous-api-security.html), and public resources should be accessible to your Laravel app without a token.

## Calling the API

Start by creating a `Client` instance, which accepts a `$scope` parameter specifying which store the call affects. The `default` value is used if no `$scope` is specified. It also accepts custom `$token` and `$baseUrl` parameters, overriding the values in your configuration. This `Client` instance can be used to call any endpoint of the API. Explore the `src/endpoints/` directory to see all of the supported calls.

```php
use Alanaktion\Magento\Client;

class Example {
    $mage = new Client('default');
}
```

## Example implementations

### Product listing

Retrieve a filtered list of products,

```php
$mage = new \Alanaktion\Magento\Client();
$mage->catalog->product->search([
    'pageSize' => 50
]);
```

### Product rendered details



## Tinkering

An excellent way to try out the integration without writing complete code is the Laravel Tinker tool.

```bash
php artisan tinker
```

```php
$mage = new Alanaktion\Magento\Client;
// Now use $mage to make API calls!
```
