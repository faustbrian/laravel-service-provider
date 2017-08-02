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
