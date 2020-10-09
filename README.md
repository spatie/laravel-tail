# Easily tail your logs

[![Latest Version](https://img.shields.io/github/release/spatie/laravel-tail.svg?style=flat-square)](https://github.com/spatie/laravel-tail/releases)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/spatie/laravel-tail/run-tests?label=tests)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-tail.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-tail)

This package offers an artisan command to tail the application log. It supports daily and single logs on your local machine.

To tail the log you can use this command:

```bash
php artisan tail
```

It can also tail logs on other environments:

```bash
php artisan tail production
```

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-tail.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-tail)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

``` bash
composer require spatie/laravel-tail
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Spatie\Tail\TailServiceProvider"
```

This is the contents of the file that will be published at `config/tail.php`:

```php
return [
    'production' => [
        
        /*
         * The host that contains your logs.
         */
        'host' => env('TAIL_HOST_PRODUCTION', ''),

        /*
         * The user to be used to SSH to the server.
         */
        'user' => env('TAIL_USER_PRODUCTION', ''),

        /*
         * The path to the directory that contains your logs.
         */
        'log_directory' => env('TAIL_LOG_DIRECTORY_PRODUCTION', ''),

        /*
         * The filename of the log file that you want to tail.
         * Leave null to let the package automatically select the file.
         */
        'file' => env('TAIL_LOG_FILE_PRODUCTION', null),
        
    ],
];
```

## Usage

To tail the local log you can use this command:

```bash
php artisan tail
```

You can start the output with displaying the last lines in the log by using the `lines`-option.

```bash
php artisan tail --lines=50
```

By default, the most-recently modified file in the directory will be used.
You can specify the file that you would like to tail by using the `file` option.

```bash
php artisan tail --file="other-file.log"
```

It's also possible to fully clear the output buffer after each log item.
This can be useful if you're only interested in the last log entry when debugging.

```bash
php artisan tail --clear
```

Should you wish to filter the log to return only certain keywords then you can also use the grep feature.

```bash
php artisan tail --grep="only display lines that contain this string"
```

### Tailing remote logs

To tail remote logs, you must first specify values for `host`, `user`, `log_directory`, and `file` keys of an environment in the `tail` config file.

After that you can tail that logs of an environment like this

```bash
php artisan tail production
```

You can also use the `--clear`, `--file`, and `--lines` options described above.

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

This package was created because [the awesome tail command present in Laravel 4](https://github.com/laravel/framework/blob/4.2/src/Illuminate/Foundation/Console/TailCommand.php) was dropped in Laravel 5. The tail command from this package is equivalent to Laravel's old one minus the remote tailing features.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
