<?php



declare(strict_types=1);

namespace BrianFaust\ServiceProvider\Publisher;

use InvalidArgumentException;

class AssetPublisher extends Publisher
{
    protected function getSource($packagePath): array
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
