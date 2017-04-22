<?php



declare(strict_types=1);

namespace BrianFaust\ServiceProvider\Loader;

use InvalidArgumentException;

class ViewLoader extends Loader
{
    protected function getSource($packagePath): string
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
