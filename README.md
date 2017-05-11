# Easily tail your logs

[![Latest Version](https://img.shields.io/github/release/spatie/laravel-tail.svg?style=flat-square)](https://github.com/spatie/laravel-tail/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie/laravel-tail.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie/laravel-tail)
[![StyleCI](https://styleci.io/repos/30608411/shield?branch=master)](https://styleci.io/repos/30608411)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-tail.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-tail)

This package offers an Artisan command to tail the application log. It supports daily and single logs and tailing both local and remote logs.

Spatie is a webdesign agency in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

## Postcardware

You're free to use this package (it's [MIT-licensed](LICENSE.md)), but if it makes it to your production environment you are required to send us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: Spatie, Samberstraat 69D, 2060 Antwerp, Belgium.

The best postcards will get published on the open source page on our website.

## Install

You can install the package via composer:

``` bash
composer require spatie/laravel-tail
```

You must install this service provider:

```php
// config/app.php

'providers' => [
    ...
    Spatie\Tail\TailServiceProvider::class,
    ...
];
```

If you're planning on tailing remote logs you must publish the config file with this command:

```bash
php artisan vendor:publish --provider="Spatie\Tail\TailServiceProvider"
```

A file named `tail.php` will be created in the config directory. The options you can set in the file should be self-explanatory.

```php
return [

    'connections' => [

        /*
         * The environment name. You can use this value in the tail command.
         */
        'production' => [

            /*
             * The hostname of the server where the logs are located
             */
            'host' => '',

            /*
             * The username to be used when connecting to the server where the logs are located
             */
            'user' => '',

            /*
             * The port to be used when connecting to the server where the logs are located
             */
            'port' => '22',

            /*
             * The full path to the directory where the logs are located
             */
            'logDirectory' => '',
        ],
    ],
];

```

## Usage

To tail the local log you can use this command:

```bash
php artisan tail
```

By default the last 20 lines will be shown. You can change that number by using the `lines`-option (`l` for short).

```bash
php artisan tail --lines=50
```

or

```bash
php artisan tail -l 50
```

To tail a remote log you must first specify `hostname` and `logDirectory` in the config-file. After you've done that you can tail the remote logs by specifify the environment as an argument:

```bash
php artisan tail production
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## About Spatie
Spatie is a webdesign agency in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource). 

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
