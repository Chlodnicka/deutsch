<?php

declare(strict_types=1);

namespace Deutsch;

use Deutsch\Word\GermanNonNoun;
use Deutsch\Word\GermanNoun;
use Deutsch\Word\PolishTranslation;

final class WordTranslationFactory
{
    public function create(array $payload): WordsTranslationMaps
    {
        $wordsMap = new WordsTranslationMaps();

        foreach ($payload as $drawedWordPayload) {
            $germanWord = $this->createWord($drawedWordPayload);
            $polishTranslations = $this->createTranslations($drawedWordPayload);
            $wordsMap->add(new WordTranslationMap($germanWord, $polishTranslations));
        }

        return $wordsMap;
    }

    private function createWord(array $payload): Word
    {
        $article = mb_strtolower($payload[0]);
        $word = $payload[1];
        if (GermanDefiniteArticle::isValid($article)) {
            return new GermanNoun(GermanDefiniteArticle::from($article), $word);
        }
        return new GermanNonNoun($word);
    }

    private function createTranslations(array $payload): array
    {
        $translations = array_slice($payload, 2, -1);
        $notEmptyTranslations = array_filter($translations);
        return array_map(
            static function (string $translation) {
                return new PolishTranslation($translation);
            },
            $notEmptyTranslations
        );
    }
}
