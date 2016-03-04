<?php

/*
 * This file is part of Laravel Service Provider.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\ServiceProvider;

trait FilesTrait
{
    /**
     * @param $file
     *
     * @return string
     */
    protected function getFileName($file)
    {
        $file = basename($file);

        if (!ends_with($file, '.php')) {
            $file = $file.'.php';
        }

        return $file;
    }

    /**
     * Get the target destination path for the files.
     *
     * @param string $package
     *
     * @return string
     */
    protected function getDestinationPath($type, $args)
    {
        return vsprintf($this->paths[$type]['dest'], $args);
    }

    /**
     * @param $type
     * @param $files
     *
     * @return array
     */
    protected function getSourceFiles($path)
    {
        $files = [];
        foreach (glob($path.'/*.php') as $file) {
            $files[] = $file;
        }

        return $files;
    }

    /**
     * @param $path
     *
     * @return mixed
     */
    protected function getClassFromFile($path)
    {
        $count = count($tokens = token_get_all(file_get_contents($path)));

        for ($i = 2; $i < $count; ++$i) {
            if ($tokens[$i - 2][0] == T_CLASS && $tokens[$i - 1][0] == T_WHITESPACE && $tokens[$i][0] == T_STRING) {
                return $tokens[$i][1];
            }
        }
    }
}
