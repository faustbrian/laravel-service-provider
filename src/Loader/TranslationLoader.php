<?php

namespace BrianFaust\ServiceProvider\Loader;

use InvalidArgumentException;

class TranslationLoader extends Loader
{
    protected function getSource($packagePath)
    {
        $sources = [
            "{$packagePath}/resources/lang",
            "{$packagePath}/lang",
        ];

        foreach ($sources as $source) {
            if ($this->files->isDirectory($source)) {
                return $source;
            }
        }

        throw new InvalidArgumentException('Translations not found.');
    }
}
