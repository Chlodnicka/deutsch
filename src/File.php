<?php

declare(strict_types=1);

namespace Deutsch;

use RuntimeException;

final class File
{
    private string $contents;

    private function __construct(string $contents)
    {
        $this->contents = $contents;
    }

    public static function create(string $path): File
    {
        if (!file_exists($path)) {
            throw  new RuntimeException("No file found in path $path");
        }

        $contents = file_get_contents($path);

        if (!$contents) {
            throw new RuntimeException("File $path cannot be opened or is empty");
        }

        return new self($contents);
    }

    public function contents(): string
    {
        return $this->contents;
    }
}