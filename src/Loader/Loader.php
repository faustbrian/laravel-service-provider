<?php

/*
 * This file is part of Laravel Service Provider.
 *
 * (c) Brian Faust <hello@brianfaust.de>
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

    public function getFileList($package)
    {
        return $this->getSource($package, $this->packagePath);
    }

    public function setPackagePath($packagePath)
    {
        $this->packagePath = $packagePath;
    }

    abstract protected function getSource($packagePath);
}
