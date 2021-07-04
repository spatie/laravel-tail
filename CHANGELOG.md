# Changelog

All notable changes to `laravel-tail` will be documented in this file

## 4.3.3 - 2021-07-04

- prefix all shell commands with backslashes to ignore aliases (#65)

## 4.3.2 - 2021-01-25

- use package service provider

### 4.3.1 - 2020-11-28

- add support for PHP 8

### 4.3.0 - 2020-10-01

- add file option (#63)

### 4.2.2 - 2020-09-09

- Support Laravel 8

### 4.2.1 - 2020-06-08

- fix `--grep` option (#60)

### 4.2.0 - 2020-03-03

- add support for Laravel 7

### 4.1.0 - 2020-02-23

- add `grep` option

### 4.0.0 - 2020-02-14

- add option to tail remotely

### 3.3.0 - 2019-09-04

- add support for Laravel 6

### 3.2.4 - 2019-02-26

- add support for Laravel 5.8

### 3.2.3 - 2018-08-20

- add `provides` to service provider

### 3.2.2 - 2018-08-20

**THIS VERSION DOES NOT WORK, DO NOT USE**
- prevent the package from being loaded in every web request

### 3.2.1 - 2018-08-20

- add support for Laravel 5.7

### 3.2.0 - 2018-08-20

- add `--hide-stack-traces` option

### 3.1.0 - 2018-04-12

- add `--clear` option

### 3.0.1 - 2018-02-07

- fix deps

### 3.0.0 - 2018-02-07

- don't display any initial output
- add support for L5.6

### 2.0.1 - 2017-08-30

- fix deps

### 2.0.0 - 2017-08-30

- add support for Laravel 5.5
- drop support for all older Laravel versions
- drop support for remote tailing

### 1.4.2 - 2017-03-21

- stabilize custom port support

### 1.4.1 - 2017-03-17
- fix backwards compatibility issue when `port` is not set in config file

### 1.4.0 - 2017-03-16
- add `port` to config file

### 1.3.0 - 2016-03-13
- add `-l` option

### 1.2.0
- Make compatible with Laravel 5.4, drop support for all older versions

### 1.1.5
- Remove L5.4 compatibility

### 1.1.4
**THIS RELEASE CONTAINS BUGS, DO NOT USE**

- Make compatible with Laravel 5.4

### 1.1.3 - 2016-11-26
- Cleanup

### 1.1.2
- Fix config file

### 1.1.1
- Move repo from freekmurze to spatie

### 1.1.0
- Add support for tailing remote logs

### 1.0.0
- Initial release
