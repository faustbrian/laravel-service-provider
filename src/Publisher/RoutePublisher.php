<?php

namespace BrianFaust\ServiceProvider\Publisher;

use InvalidArgumentException;

class RoutePublisher extends Publisher
{
    protected function getSource($packagePath)
    {
        $sources = [
            "{$packagePath}/resources/routes",
            "{$packagePath}/routes",
        ];

        foreach ($sources as $source) {
            if ($this->files->isDirectory($source)) {
                return $source;
            }
        }

        throw new InvalidArgumentException('Configuration not found.');
    }
}
