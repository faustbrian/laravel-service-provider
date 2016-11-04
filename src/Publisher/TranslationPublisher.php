<?php

namespace BrianFaust\ServiceProvider\Publisher;

use InvalidArgumentException;

class TranslationPublisher extends Publisher
{
    protected function getSource($packagePath)
    {
        $sources = [
            "{$packagePath}/resources/lang",
            "{$packagePath}/lang",
        ];

        foreach ($sources as $source) {
            if ($this->files->isDirectory($source)) {
                return [$source => $this->publishPath.'/'.$this->packageName];
            }
        }

        throw new InvalidArgumentException('Translations not found.');
    }
}
