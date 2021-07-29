<?php

declare(strict_types=1);

namespace Deutsch\Tests;

use Deutsch\File;
use Deutsch\Tests\Utils\FileHandler;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * @covers \Deutsch\File
 */
class FileTest extends TestCase
{
    private const TMP_DIR = 'tmp';

    public function testShouldCreateFile(): void
    {
        // Given
        $contents = 'some content';
        $filePath = __DIR__ . '/tmp/someExistingFile.txt';
        file_put_contents($filePath, $contents);

        // When
        $file = File::create($filePath);

        // Then
        self::assertSame($contents, $file->contents());
    }

    public function testShouldNotCreateFileBecauseFileDoesNotExist(): void
    {
        // Given
        $fileName = 'someNonExistingFile.txt';

        // Expect
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage("No file found in path $fileName");

        // When
        File::create($fileName);
    }

    public function testShouldNotCreateFileBecauseFileIsEmpty(): void
    {
        // Given
        $contents = '';
        $filePath = __DIR__ . '/tmp/someExistingFile.txt';
        file_put_contents($filePath, $contents);

        // Expect
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage("File $filePath cannot be opened or is empty");

        // When
        File::create($filePath);
    }

    protected function setUp(): void
    {
        $tmpDir = self::getTmpDir();
        FileHandler::createDirectory($tmpDir);
    }

    private static function getTmpDir(): string
    {
        return __DIR__ . '/' . self::TMP_DIR;
    }

    protected function tearDown(): void
    {
        $tmpDir = self::getTmpDir();
        FileHandler::removeDirectory($tmpDir);
    }
}
