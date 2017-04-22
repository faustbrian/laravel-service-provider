<?php



declare(strict_types=1);

namespace BrianFaust\ServiceProvider\Publisher;

use InvalidArgumentException;

class TranslationPublisher extends Publisher
{
    protected function getSource($packagePath): array
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
