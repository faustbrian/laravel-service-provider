<?php

namespace BrianFaust\ServiceProvider\Publisher;

use InvalidArgumentException;

class AssetPublisher extends Publisher
{
    protected function getSource($packagePath)
    {
        $sources = [
            "{$packagePath}/resources/public",
            "{$packagePath}/public",
        ];

        foreach ($sources as $source) {
            if ($this->files->isDirectory($source)) {
                return [$source => $this->publishPath];
            }
        }

        throw new InvalidArgumentException('Assets not found.');
    }
}
