# Laravel Service Provider

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

## Security

If you discover a security vulnerability within this package, please send an e-mail to Brian Faust at hello@brianfaust.de. All security vulnerabilities will be promptly addressed.

## License

The [The MIT License (MIT)](LICENSE). Please check the [LICENSE](LICENSE) file for more details.
