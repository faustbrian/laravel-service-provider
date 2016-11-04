<?php

namespace BrianFaust\ServiceProvider\Publisher;

use InvalidArgumentException;

class ViewPublisher extends Publisher
{
    protected function getSource($packagePath)
    {
        $sources = [
            "{$packagePath}/resources/views",
            "{$packagePath}/views",
        ];

        foreach ($sources as $source) {
            if ($this->files->isDirectory($source)) {
                return [$source => $this->publishPath.'/'.$this->packageName];
            }
        }

        throw new InvalidArgumentException('Views not found.');
    }
}
