<?php


declare(strict_types=1);

/*
 * This file is part of Laravel Service Provider.
 *
 * (c) Brian Faust <hello@brianfaust.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\ServiceProvider\Publisher;

use InvalidArgumentException;

class RoutePublisher extends Publisher
{
    protected function getSource($packagePath): array
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
