<?php

declare(strict_types=1);

namespace Deutsch\Tests\Utils;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

final class FileHandler
{
    public static function createDirectory(string $path): void
    {
        if (!file_exists($path)) {
            mkdir($path);
        }
    }

    public static function removeDirectory(string $path): void
    {
        $directory = new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($files as $file) {
            if ($file->isDir()) {
                rmdir($file->getPathname());
            } else {
                unlink($file->getPathname());
            }
        }
        rmdir($path);
    }
}
