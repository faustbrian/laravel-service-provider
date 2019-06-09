# Laravel Service Provider

[![Build Status](https://img.shields.io/travis/artisanry/Service-Provider/master.svg?style=flat-square)](https://travis-ci.org/artisanry/Service-Provider)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/artisanry/service-provider.svg?style=flat-square)]()
[![Latest Version](https://img.shields.io/github/release/artisanry/Service-Provider.svg?style=flat-square)](https://github.com/artisanry/Service-Provider/releases)
[![License](https://img.shields.io/packagist/l/artisanry/Service-Provider.svg?style=flat-square)](https://packagist.org/packages/artisanry/Service-Provider)

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

``` bash
$ composer require artisanry/service-provider
```

## Usage

``` php
<?php

namespace Vendor\Package;

class ServiceProvider extends \Artisanry\ServiceProvider\ServiceProvider
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

If you discover a security vulnerability within this package, please send an e-mail to hello@basecode.sh. All security vulnerabilities will be promptly addressed.

## Credits

This project exists thanks to all the people who [contribute](../../contributors).

## License

Mozilla Public License Version 2.0 ([MPL-2.0](./LICENSE)).
