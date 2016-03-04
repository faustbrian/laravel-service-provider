# Laravel Service Provider

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

## Install

Via Composer

``` bash
$ composer require draperstudio/laravel-service-provider
```

## Usage

``` php
<?php

/*
 * This file is part of Laravel :package_name.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vendor\Package;

use Illuminate\Support\ServiceProvider as BaseProvider;

class ServiceProvider extends \DraperStudio\ServiceProvider\ServiceProvider
{
    public function boot()
    {

             ->publishMigrations()
             ->publishConfig()
             ->publishViews()
             ->publishAssets()
             ->loadViews()
             ->loadTranslations()
             ->mergeConfig('package');
    }
}
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email hello@draperstudio.tech instead of using the issue tracker.

## Credits

- [DraperStudio][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/DraperStudio/laravel-service-provider.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/DraperStudio/Laravel-Service-Provider/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/DraperStudio/laravel-service-provider.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/DraperStudio/laravel-service-provider.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/DraperStudio/laravel-service-provider.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/DraperStudio/laravel-service-provider
[link-travis]: https://travis-ci.org/DraperStudio/Laravel-Service-Provider
[link-scrutinizer]: https://scrutinizer-ci.com/g/DraperStudio/laravel-service-provider/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/DraperStudio/laravel-service-provider
[link-downloads]: https://packagist.org/packages/DraperStudio/laravel-service-provider
[link-author]: https://github.com/DraperStudio
[link-contributors]: ../../contributors
