<?php



declare(strict_types=1);

namespace BrianFaust\ServiceProvider\Loader;

use Illuminate\Filesystem\Filesystem;

abstract class Loader
{
    protected $files;

    protected $packagePath;

    public function __construct(Filesystem $files)
    {
        $this->files = $files;
    }

    public function getFileList($package): string
    {
        return $this->getSource($package, $this->packagePath);
    }

    public function setPackagePath($packagePath): void
    {
        $this->packagePath = $packagePath;
    }

    abstract protected function getSource($packagePath): string;
}
