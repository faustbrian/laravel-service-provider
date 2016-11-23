<?php

namespace BrianFaust\ServiceProvider;

use Illuminate\Contracts\Foundation\Application;

abstract class AbstractServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $packagePath;
    protected $packageName;

    public function boot()
    {
    }

    public function register()
    {
        $this->packagePath = $this->getPackagePath();
        $this->packageName = $this->getPackageName();

        $this->registerAssetPublisher();

        $this->registerConfigPublisher();

        $this->registerViewPublisher();

        $this->registerMigrationPublisher();

        $this->registerSeedPublisher();

        $this->registerTranslationPublisher();

        $this->registerViewLoader();

        $this->registerRouteLoader();

        $this->registerTranslationLoader();
    }

    public function provides()
    {
        return [
            'publisher.asset',
            'publisher.config',
            'publisher.views',
            'publisher.migrations',
            'publisher.seeds',
            'publisher.translations',
            'loader.views',
            'loader.routes',
            'loader.translations',
        ];
    }

    protected function publishConfig()
    {
        $this->publishes(
            $this->app['publisher.config']->getFileList($this->packagePath),
            'config'
        );
    }

    protected function publishMigrations()
    {
        $this->publishes(
            $this->app['publisher.migrations']->getFileList($this->packagePath),
            'migrations'
        );
    }

    protected function publishViews()
    {
        $this->publishes(
            $this->app['publisher.views']->getFileList($this->packagePath),
            'views'
        );
    }

    protected function publishAssets()
    {
        $this->publishes(
            $this->app['publisher.asset']->getFileList($this->packagePath),
            'assets'
        );
    }

    protected function publishSeeds()
    {
        $this->publishes(
            $this->app['publisher.seeds']->getFileList($this->packagePath),
            'seeds'
        );
    }

    protected function loadViews()
    {
        $this->loadViewsFrom(
            $this->app['loader.views']->getFileList($this->packagePath),
            $this->packageName
        );
    }

    protected function loadTranslations()
    {
        $this->loadTranslationsFrom(
            $this->app['loader.translations']->getFileList($this->packagePath),
            $this->packageName
        );
    }

    protected function loadRoutes()
    {
        if (!$this->app->routesAreCached()) {
            require $this->app['loader.routes']->getFileList($this->packagePath);
        }
    }

    protected function mergeConfig()
    {
        $this->mergeConfigFrom(
            $this->packagePath.'/resources/config/'.$this->getFileName($this->packageName),
            $this->packageName
        );
    }

    protected function getPackagePath()
    {
        return dirname((new \ReflectionClass($this))->getFileName()).'/..';
    }

    abstract protected function getPackageName();

    protected function registerAssetPublisher()
    {
        $packagePath = $this->packagePath;
        $packageName = $this->packageName;

        $this->app->singleton('publisher.asset', function (Application $app) use ($packagePath, $packageName) {
            $publicPath = $app->publicPath();

            $publisher = new Publisher\AssetPublisher($app->make('files'), $publicPath);

            $publisher->setPackagePath($packagePath);
            $publisher->setPackageName($packageName);

            return $publisher;
        });
    }

    protected function registerConfigPublisher()
    {
        $packagePath = $this->packagePath;
        $packageName = $this->packageName;

        $this->app->singleton('publisher.config', function (Application $app) use ($packagePath, $packageName) {
            $path = $app->configPath();

            $publisher = new Publisher\ConfigPublisher($app->make('files'), $path);

            $publisher->setPackagePath($packagePath);
            $publisher->setPackageName($packageName);

            return $publisher;
        });
    }

    protected function registerViewPublisher()
    {
        $packagePath = $this->packagePath;
        $packageName = $this->packageName;

        $this->app->singleton('publisher.views', function (Application $app) use ($packagePath, $packageName) {
            $viewPath = $app->basePath().'/resources/views/vendor';

            $publisher = new Publisher\ViewPublisher($app->make('files'), $viewPath);

            $publisher->setPackagePath($packagePath);
            $publisher->setPackageName($packageName);

            return $publisher;
        });
    }

    protected function registerMigrationPublisher()
    {
        $packagePath = $this->packagePath;
        $packageName = $this->packageName;

        $this->app->singleton('publisher.migrations', function (Application $app) use ($packagePath, $packageName) {
            $viewPath = $app->databasePath().'/migrations';

            $publisher = new Publisher\MigrationPublisher($app->make('files'), $viewPath);

            $publisher->setPackagePath($packagePath);
            $publisher->setPackageName($packageName);

            return $publisher;
        });
    }

    protected function registerSeedPublisher()
    {
        $packagePath = $this->packagePath;
        $packageName = $this->packageName;

        $this->app->singleton('publisher.seeds', function (Application $app) use ($packagePath, $packageName) {
            $viewPath = $app->databasePath().'/seeds';

            $publisher = new Publisher\SeedPublisher($app->make('files'), $viewPath);

            $publisher->setPackagePath($packagePath);
            $publisher->setPackageName($packageName);

            return $publisher;
        });
    }

    protected function registerTranslationPublisher()
    {
        $packagePath = $this->packagePath;
        $packageName = $this->packageName;

        $this->app->singleton('publisher.translations', function (Application $app) use ($packagePath, $packageName) {
            $viewPath = $app->basePath().'/resources/lang/vendor';

            $publisher = new Publisher\TranslationPublisher($app->make('files'), $viewPath);

            $publisher->setPackagePath($packagePath);
            $publisher->setPackageName($packageName);

            return $publisher;
        });
    }

    protected function registerViewLoader()
    {
        $packagePath = $this->packagePath;

        $this->app->singleton('loader.views', function (Application $app) use ($packagePath) {
            $publisher = new Loader\ViewLoader($app->make('files'));

            $publisher->setPackagePath($packagePath);

            return $publisher;
        });
    }

    protected function registerRouteLoader()
    {
        $packagePath = $this->packagePath;

        $this->app->singleton('loader.routes', function (Application $app) use ($packagePath) {
            $publisher = new Loader\RouteLoader($app->make('files'));

            $publisher->setPackagePath($packagePath);

            return $publisher;
        });
    }

    protected function registerTranslationLoader()
    {
        $packagePath = $this->packagePath;

        $this->app->singleton('loader.translations', function (Application $app) use ($packagePath) {
            $publisher = new Loader\TranslationLoader($app->make('files'));

            $publisher->setPackagePath($packagePath);

            return $publisher;
        });
    }

    protected function getFileName($file)
    {
        $file = basename($file);

        if (!ends_with($file, '.php')) {
            $file = $file.'.php';
        }

        return $file;
    }
}
