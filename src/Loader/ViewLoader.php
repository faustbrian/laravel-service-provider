<?php

namespace BrianFaust\ServiceProvider\Loader;

use InvalidArgumentException;

class ViewLoader extends Loader
{
    protected function getSource($packagePath)
    {
        $sources = [
            "{$packagePath}/resources/views",
            "{$packagePath}/views",
        ];

        foreach ($sources as $source) {
            if ($this->files->isDirectory($source)) {
                return $source;
            }
        }

        throw new InvalidArgumentException('Views not found.');
    }
}
