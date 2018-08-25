# Easily tail your logs

[![Latest Version](https://img.shields.io/github/release/spatie/laravel-tail.svg?style=flat-square)](https://github.com/spatie/laravel-tail/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie/laravel-tail.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie/laravel-tail)
[![StyleCI](https://styleci.io/repos/30608411/shield?branch=master)](https://styleci.io/repos/30608411)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-tail.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-tail)

This package offers an Artisan command to tail the application log. It supports daily and single logs on your local machine.

Spatie is a webdesign agency in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

## Install

You can install the package via composer:

``` bash
composer require spatie/laravel-tail
```

You're done. Run `php artisan tail` to tail your log.

## Usage

To tail the log you can use this command:

```bash
php artisan tail
```

You can start the output with displaying the last lines in the log by using the `lines`-option.

```bash
php artisan tail --lines=50
```

To filter out stack traces from the output, you can use the `hide-stack-traces`-option (or `H`).

```bash
php artisan tail --hide-stack-traces
```

To add some color/hightlight the logs add `color`-option (or `C`).

```bash
php artisan tail --color
```

You can combine the options too. To hide stack traces and add color:

```bash
php artisan tail -HC
```

It's also possible to fully clear the output buffer after each log item.
This can be useful if you're only interested in the last log entry when debugging.

```bash
php artisan tail --clear
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Postcardware

You're free to use this package, but if it makes it to your production environment we highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: Spatie, Samberstraat 69D, 2060 Antwerp, Belgium.

We publish all received postcards [on our company website](https://spatie.be/en/opensource/postcards).

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

This package was created because [the awesome tail command present in Laravel 4](https://github.com/laravel/framework/blob/4.2/src/Illuminate/Foundation/Console/TailCommand.php) was dropped in Laravel 5. The tail command from this package is equivalent to Laravel's old one minus the remote tailing features.

## Support us

Spatie is a webdesign agency based in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

Does your business depend on our contributions? Reach out and support us on [Patreon](https://www.patreon.com/spatie). 
All pledges will be dedicated to allocating workforce on maintenance and new awesome stuff.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
