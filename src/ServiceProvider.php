<?php



namespace DraperStudio\ServiceProvider;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider as IlluminateProvider;


class ServiceProvider extends IlluminateProvider
{

    protected $packageName;


    protected $paths = [];


    public function boot()
    {
        //
    }


    public function register()
    {
        //
    }


    public function setup($path)
    {
        $this->paths = [
            'migrations' => [
                'src' => $path.'/../database/migrations',
                'dest' => database_path('/migrations/%s_%s'),
            ],
            'seeds' => [
                'src' => $path.'/../database/seeds',
                'dest' => database_path('/seeds/%s'),
            ],
            'config' => [
                'src' => $path.'/../config',
                'dest' => config_path('%s'),
            ],
            'views' => [
                'src' => $path.'/../resources/views',
                'dest' => base_path('resources/views/vendor/%s'),
            ],
            'translations' => [
                'src' => $path.'/../resources/lang',
                'dest' => base_path('resources/lang/%s'),
            ],
            'assets' => [
                'src' => $path.'/../public/assets',
                'dest' => public_path('vendor/%s'),
            ],
            'routes' => [
                'src' => $path.'/Http/routes.php',
                'dest' => null,
            ],
        ];

        return $this;
    }


    protected function publishConfig(array $files = [])
    {
        $files = $this->buildFilesArray('config', $files);

        $paths = [];
        foreach ($files as $file) {
            $destPath = $this->buildDestPath('config', [$this->buildFileName($file)]);

            if (!File::exists($destPath)) {
                $paths[$file] = $destPath;
            }
        }

        $this->publishes($paths, 'config');

        return $this;
    }


    protected function publishMigrations(array $files = [])
    {
        $files = $this->buildFilesArray('migrations', $files);

        $paths = [];
        foreach ($files as $file) {
            if (!class_exists($this->getClassFromFile($file))) {
                $paths[$file] = $this->buildDestPath('migrations', [
                    date('Y_m_d_His', time()), $this->buildFileName($file),
                ]);
            }
        }

        $this->publishes($paths, 'migrations');

        return $this;
    }


    protected function publishViews()
    {
        $destPath = $this->buildDestPath('views', $this->packageName);

        if (!File::exists($destPath)) {
            $this->publishes([
                $this->paths['views']['src'] => $destPath,
            ], 'views');
        }

        return $this;
    }


    protected function publishAssets()
    {
        $destPath = $this->buildDestPath('assets', $this->packageName);

        if (!File::exists($destPath)) {
            $this->publishes([
                $this->paths['assets']['src'] => $destPath,
            ], 'public');
        }

        return $this;
    }


    protected function publishSeeds(array $files = [])
    {
        $files = $this->buildFilesArray('seeds', $files);

        $paths = [];
        foreach ($files as $file) {
            $destPath = $this->buildDestPath('seeds', [$this->buildFileName($file)]);

            if (!File::exists($destPath)) {
                $paths[$file] = $destPath;
            }
        }

        $this->publishes($paths, 'seeds');

        return $this;
    }


    protected function loadViews()
    {
        $this->loadViewsFrom($this->paths['views']['src'], $this->packageName);

        return $this;
    }


    protected function loadTranslations()
    {
        $this->loadTranslationsFrom(
            $this->paths['translations']['src'], $this->packageName
        );

        return $this;
    }


    protected function loadRoutes()
    {
        if (!$this->app->routesAreCached()) {
            require $this->paths['routes']['src'];
        }

        return $this;
    }


    protected function publish(array $paths, $group = null)
    {
        $this->publishes($paths, $group);

        return $this;
    }


    protected function mergeConfig($file = null)
    {
        if (empty($file)) {
            $file = $this->packageName;
        }

        $this->mergeConfigFrom(
            $this->paths['config']['src'].'/'.$this->buildFileName($file),
            $this->packageName
        );

        return $this;
    }


    private function buildFileName($file)
    {
        $file = basename($file);

        if (!ends_with($file, '.php')) {
            $file = $file.'.php';
        }

        return $file;
    }


    private function buildDestPath($type, $args)
    {
        return vsprintf($this->paths[$type]['dest'], $args);
    }


    private function buildFilesArray($type, $files)
    {
        $path = $this->paths[$type]['src'];

        if (empty($files)) {
            $files = [];

            foreach (glob($path.'/*.php') as $file) {
                $files[] = $file;
            }
        } else {
            foreach ($files as $key => $value) {
                $files[] = $path.'/'.$this->buildFileName($value);
                unset($files[$key]);
            }
        }

        return $files;
    }
    
    private function getClassFromFile($path)
    {
        $count = count($tokens = token_get_all(file_get_contents($path)));

        for ($i = 2; $i < $count; ++$i) {
            if ($tokens[$i - 2][0] == T_CLASS && $tokens[$i - 1][0] == T_WHITESPACE && $tokens[$i][0] == T_STRING) {
                return $tokens[$i][1];
            }
        }
    }
}
