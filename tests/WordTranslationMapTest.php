<?php

namespace Deutsch\Tests;

use Deutsch\GermanDefiniteArticle;
use Deutsch\Word\GermanNoun;
use Deutsch\Word\PolishTranslation;
use Deutsch\WordTranslationMap;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Deutsch\WordTranslationMap
 */
class WordTranslationMapTest extends TestCase
{
    private WordTranslationMap $wordTranslationMap;

    public function testShouldGetWord(): void
    {
        // Then
        self::assertSame('die Leistung', $this->wordTranslationMap->word());
    }

    public function testShouldGetAnyTranslation(): void
    {
        // When
        $anyTranslation = $this->wordTranslationMap->anyTranslation();

        // Then
        self::assertContains($anyTranslation, ['usługa, świadczenie', 'rezultat']);
    }

    public function testShouldGetAllTranslations(): void
    {
        // When
        $allTranslations = $this->wordTranslationMap->allTranslations();

        // Then
        self::assertSame('usługa, świadczenie | rezultat', $allTranslations);
    }

    protected function setUp(): void
    {
        $this->wordTranslationMap = new WordTranslationMap(
            new GermanNoun(GermanDefiniteArticle::DIE(), 'Leistung'),
            [
                new PolishTranslation('usługa, świadczenie'),
                new PolishTranslation('rezultat')
            ]
        );
    }
}
