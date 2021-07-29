<?php

namespace Deutsch\Tests;

use Deutsch\WordTranslationFactory;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Deutsch\WordTranslationFactory
 */
class WordTranslationFactoryTest extends TestCase
{
    private WordTranslationFactory $wordTranslationFactory;

    public function testShouldCreateTranslationMap(): void
    {
        // Given
        $payload = [
            [
                'der',
                'Tisch',
                'stół'
            ],
            [
                '',
                'vermutlich',
                'przypuszczalnie',
                'prawdopodonie'
            ]
        ];

        // When
        $wordsTranslationMaps = $this->wordTranslationFactory->create($payload);
        $wordsTranslationMaps->printMap();

        // Then
        self::assertCount(2, $wordsTranslationMaps);
    }

    protected function setUp(): void
    {
        $this->wordTranslationFactory = new WordTranslationFactory();
    }
}
