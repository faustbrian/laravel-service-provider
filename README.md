# Laravel Service Provider

## Installation

First, pull in the package through Composer.

```js
composer require draperstudio/laravel-service-provider:1.0.*@dev
```

## Usage

```php
<?php

namespace Vendor\Package;

use DraperStudio\ServiceProvider\ServiceProvider as BaseProvider;

class ServiceProvider extends BaseProvider
{
    public function boot()
    {
        $this->setup(__DIR__)
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

## License

Laravel Service Provider is licensed under [The MIT License (MIT)](LICENSE).
