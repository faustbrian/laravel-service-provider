<?php


declare(strict_types=1);

/*
 * This file is part of Laravel Service Provider.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\ServiceProvider\Loader;

use InvalidArgumentException;

class RouteLoader extends Loader
{
    protected function getSource($packagePath): string
    {
        $sources = [
            "{$packagePath}/resources/routes.php",
            "{$packagePath}/src/Http/routes.php",
            "{$packagePath}/src/routes.php",
        ];

        foreach ($sources as $source) {
            if ($this->files->isFile($source)) {
                return $source;
            }
        }

        throw new InvalidArgumentException('Routes not found.');
    }
}
