# Laravel D4Sign Client (SDK)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/emaia/laravel-d4sign.svg?style=flat-square)](https://packagist.org/packages/emaia/laravel-d4sign)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/emaia/laravel-d4sign/run-tests?label=tests)](https://github.com/emaia/laravel-d4sign/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/emaia/laravel-d4sign/Check%20&%20fix%20styling?label=code%20style)](https://github.com/emaia/laravel-d4sign/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/emaia/laravel-d4sign.svg?style=flat-square)](https://packagist.org/packages/emaia/laravel-d4sign)

Pacote de integração da API D4Sign https://d4sign.com.br

## Installation

You can install the package via composer:

```bash
composer require emaia/laravel-d4sign
```

Add your D4Sign token key and crypt key in the .env

```
D4SIGN_TOKEN_API=*******  
D4SIGN_CRYPT_KEY=*******
```

## Usage

```php
$balance = D4sign::account()->balance();
```

## Testing

```bash
composer test
```

Para executar os testes utilizando requisições à API:  
`cp phpunit.xml.dist phpunit.xml`  
Adicione as chaves de integração `D4SIGN_TOKEN_API` e `D4SIGN_CRYPT_KEY` e execute o comando:

```bash
composer test-integration
```

## D4sign API docs

http://docapi.d4sign.com.br

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
