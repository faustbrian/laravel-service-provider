<?php


declare(strict_types=1);

/*
 * This file is part of Laravel Service Provider.
 *
 * (c) Brian Faust <hello@brianfaust.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\ServiceProvider\Publisher;

use Illuminate\Filesystem\Filesystem;

abstract class Publisher
{
    protected $files;

    protected $publishPath;

    protected $packagePath;

    protected $destinationPaths;

    public function __construct(Filesystem $files, $publishPath)
    {
        $this->files = $files;
        $this->publishPath = $publishPath;

        $this->destinationPaths = [
            'migrations'   => database_path('/migrations/%s_%s'),
            'seeds'        => database_path('/seeds/%s'),
            'config'       => config_path('%s'),
            'views'        => base_path('resources/views/vendor/%s'),
            'translations' => base_path('resources/lang/%s'),
            'assets'       => public_path('vendor/%s'),
            'routes'       => null,
        ];
    }

    public function getFileList($package): array
    {
        return $this->getSource($package, $this->packagePath);
    }

    public function setPackagePath($packagePath): void
    {
        $this->packagePath = $packagePath;
    }

    public function setPackageName($packageName): void
    {
        $this->packageName = $packageName;
    }

    abstract protected function getSource($packagePath): array;

    protected function getFileName($file): string
    {
        $file = basename($file);

        if (! ends_with($file, '.php')) {
            $file = $file.'.php';
        }

        return $file;
    }

    protected function getDestinationPath($type, $args): string
    {
        return vsprintf($this->destinationPaths[$type], $args);
    }

    protected function getSourceFiles($path): array
    {
        $files = [];
        foreach (glob($path.'/*.php') as $file) {
            $files[] = $file;
        }

        return $files;
    }

    protected function getClassFromFile($path): ?string
    {
        $count = count($tokens = token_get_all(file_get_contents($path)));

        for ($i = 2; $i < $count; $i++) {
            if ($tokens[$i - 2][0] == T_CLASS && $tokens[$i - 1][0] == T_WHITESPACE && $tokens[$i][0] == T_STRING) {
                return $tokens[$i][1];
            }
        }
    }
}
