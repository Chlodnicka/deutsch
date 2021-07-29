<?php

declare(strict_types=1);

namespace Deutsch;


final class WordTranslationMap
{
    private Word $word;
    /** @var Word[] */
    private array $translations;
    private int $numberOfTranslations;

    public function __construct(Word $word, array $translations)
    {
        $this->word = $word;
        $this->translations = $translations;
        $this->numberOfTranslations = count($translations);
    }

    public function word(): string
    {
        return $this->word->get();
    }

    public function anyTranslation(): string
    {
        if ($this->numberOfTranslations === 1) {
            return $this->translations[0]->get();
        }

        $key = random_int(0, $this->numberOfTranslations - 1);
        return $this->translations[$key]->get();
    }

    public function allTranslations(): string
    {
        return implode(
            ' | ',
            array_map(
                static function (Word $word) {
                    return $word->get();
                },
                $this->translations
            )
        );
    }
}

