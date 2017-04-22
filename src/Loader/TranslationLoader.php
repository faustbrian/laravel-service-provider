<?php



declare(strict_types=1);

namespace BrianFaust\ServiceProvider\Loader;

use InvalidArgumentException;

class TranslationLoader extends Loader
{
    protected function getSource($packagePath): string
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
