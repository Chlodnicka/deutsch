<?php

declare(strict_types=1);

namespace Deutsch\Word;

use Deutsch\Word;

final class PolishTranslation implements Word
{
    private string $translation;

    public function __construct(string $translation)
    {
        $this->translation = $translation;
    }

    public function get(): string
    {
        return $this->translation;
    }
}
