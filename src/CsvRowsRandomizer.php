<?php

declare(strict_types=1);

namespace Deutsch;

use RuntimeException;

final class CsvRowsRandomizer
{
    private const ROWS_TO_DRAW_MAX_NUMBER = 100;

    public function draw(File $file, int $numberOfRowsToDraw): array
    {
        if ($numberOfRowsToDraw > self::ROWS_TO_DRAW_MAX_NUMBER) {
            throw new RuntimeException('Too many rows to draw');
        }

        $rows = str_getcsv($file->contents(), "\n");
        $totalNumberOfRows = count($rows);

        $numberOfRowsToDraw = $this->getNumberOfRowsToDraw($totalNumberOfRows, $numberOfRowsToDraw);

        $drawnRows = $this->drawRows($totalNumberOfRows, $numberOfRowsToDraw);

        return array_map(
            static function (int $key) use ($rows) {
                return str_getcsv($rows[$key], ';');
            },
            $drawnRows
        );
    }

    private function getNumberOfRowsToDraw(int $totalNumberOfRows, int $numberOfRowsToDraw): int
    {
        return $numberOfRowsToDraw > $totalNumberOfRows ? $totalNumberOfRows : $numberOfRowsToDraw;
    }

    private function drawRows(int $totalNumberOfRows, int $numberOfRowsToDraw): array
    {
        $numbers = range(0, $totalNumberOfRows - 1);
        shuffle($numbers);
        return array_slice($numbers, 0, $numberOfRowsToDraw);
    }
}