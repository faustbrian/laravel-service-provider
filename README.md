# Laravel Service Provider

[![Build Status](https://img.shields.io/travis/faustbrian/Laravel-Service-Provider/master.svg?style=flat-square)](https://travis-ci.org/faustbrian/Laravel-Service-Provider)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/faustbrian/laravel-service-provider.svg?style=flat-square)]()
[![Latest Version](https://img.shields.io/github/release/faustbrian/Laravel-Service-Provider.svg?style=flat-square)](https://github.com/faustbrian/Laravel-Service-Provider/releases)
[![License](https://img.shields.io/packagist/l/faustbrian/Laravel-Service-Provider.svg?style=flat-square)](https://packagist.org/packages/faustbrian/Laravel-Service-Provider)

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

``` bash
$ composer require faustbrian/laravel-service-provider
```

## Usage

``` php
<?php

namespace Vendor\Package;

class ServiceProvider extends \BrianFaust\ServiceProvider\ServiceProvider
{
    public function boot()
    {
        $this->publishMigrations();
        $this->publishConfig();
        $this->publishViews();
        $this->publishAssets();
        $this->loadViews();
        $this->loadTranslations();
    }

    public function register()
    {
        $this->mergeConfig();
    }
}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover a security vulnerability within this package, please send an e-mail to hello@brianfaust.me. All security vulnerabilities will be promptly addressed.

## Credits

- [Brian Faust](https://github.com/faustbrian)
- [All Contributors](../../contributors)

## License

[MIT](LICENSE) © [Brian Faust](https://brianfaust.me)
