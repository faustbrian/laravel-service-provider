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
