<?php

namespace Deutsch\Tests;

use Deutsch\CsvRowsRandomizer;
use Deutsch\File;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * @covers \Deutsch\CsvRowsRandomizer
 */
class CsvRowsRandomizerTest extends TestCase
{
    private File $file;
    private CsvRowsRandomizer $csvRowsRandomizer;

    public function testShouldDrawConcreteNumberOfRowsFromCsv(): void
    {
        // Given
        $numberOfRowsToDraw = 10;

        // When
        $result = $this->csvRowsRandomizer->draw($this->file, $numberOfRowsToDraw);

        // Then
        self::assertCount($numberOfRowsToDraw, $result);
    }

    public function testShouldSelectAllRowsFromCsv(): void
    {
        // Given
        $numberOfRowsToDraw = 99;

        // When
        $result = $this->csvRowsRandomizer->draw($this->file, $numberOfRowsToDraw);

        // Then
        self::assertCount(count($result), $result);
    }

    public function testShouldDrawMaxNumberOfRowsFromCsv(): void
    {
        // Given
        $numberOfRowsToDraw = 100;

        // When
        $result = $this->csvRowsRandomizer->draw($this->file, $numberOfRowsToDraw);

        // Then
        self::assertCount($numberOfRowsToDraw, $result);
    }

    public function testShouldNotDrawRowsFromCsvBecauseLimitHasBeenExceeded(): void
    {
        // Expect
        $this->expectException(RuntimeException::class);

        // Given
        $numberOfRowsToDraw = 101;

        // When
        $this->csvRowsRandomizer->draw($this->file, $numberOfRowsToDraw);
    }

    protected function setUp(): void
    {
        $filePath = __DIR__ . '/resources/worter_test.csv';
        $this->file = File::create($filePath);
        $this->csvRowsRandomizer = new CsvRowsRandomizer();
    }

}
