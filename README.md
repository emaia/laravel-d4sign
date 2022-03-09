# This is my package laravel-d4sign

[![Latest Version on Packagist](https://img.shields.io/packagist/v/emaia/laravel-d4sign.svg?style=flat-square)](https://packagist.org/packages/emaia/laravel-d4sign)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/emaia/laravel-d4sign/run-tests?label=tests)](https://github.com/emaia/laravel-d4sign/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/emaia/laravel-d4sign/Check%20&%20fix%20styling?label=code%20style)](https://github.com/emaia/laravel-d4sign/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/emaia/laravel-d4sign.svg?style=flat-square)](https://packagist.org/packages/emaia/laravel-d4sign)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require emaia/laravel-d4sign
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-d4sign-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-d4sign-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-d4sign-views"
```

## Usage

```php
$d4sign = new Emaia\D4sign();
echo $d4sign->echoPhrase('Hello, Emaia!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Ednilson Maia](https://github.com/emaia)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
