# The missing tail command for Laravel 5

[![Latest Version](https://img.shields.io/github/release/spatie/laravel-tail.svg?style=flat-square)](https://github.com/freekmurze/laravel-tail/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Quality Score](https://img.shields.io/scrutinizer/g/freekmurze/laravel-tail.svg?style=flat-square)](https://scrutinizer-ci.com/g/freekmurze/laravel-tail)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-tail.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-tail)

This package brings provides a tail command for Laravel 5. Currently only tailing the local logs is supported.

## Install

You can install the package via composer:

``` bash
$ composer require spatie/laravel-tail
```
You must install this service provider:
```php
// Laravel 5: config/app.php

'providers' => [
    ...
    'Spatie\Tail\TailServiceProvider',
    ...
];
```

## Usage
To tail the last log file you can use this command:
``` bash
php artisan tail
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
