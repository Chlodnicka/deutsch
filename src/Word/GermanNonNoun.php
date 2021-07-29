<?php

declare(strict_types=1);

namespace Deutsch\Word;

use Deutsch\Word;

final class GermanNonNoun implements Word
{
    private string $word;

    public function __construct(string $word)
    {
        $this->word = $word;
    }

    public function get(): string
    {
        return $this->word;
    }
}
