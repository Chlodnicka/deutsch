<?php

declare(strict_types=1);

namespace Deutsch\Word;

use Deutsch\GermanDefiniteArticle;
use Deutsch\Word;

final class GermanNoun implements Word
{
    private GermanDefiniteArticle $article;
    private string $word;

    public function __construct(GermanDefiniteArticle $article, string $word)
    {
        $this->article = $article;
        $this->word = $word;
    }

    public function get(): string
    {
        return $this->article . ' ' . $this->word;
    }
}