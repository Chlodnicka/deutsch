<?php

declare(strict_types=1);

namespace Deutsch;

use ArrayIterator;
use IteratorIterator;

final class WordsTranslationMaps extends IteratorIterator
{
    public function __construct()
    {
        parent::__construct(new ArrayIterator());
    }

    public function add(WordTranslationMap $wordTranslationMap): void
    {
        /** @var ArrayIterator $arrayIterator */
        $arrayIterator = $this->getInnerIterator();
        $arrayIterator->append($wordTranslationMap);
    }

    public function printWords(): void
    {
        $this->rewind();
        while ($this->valid()) {
            print_r($this->current()->word() . PHP_EOL);
            $this->next();
        }
    }

    public function current(): WordTranslationMap
    {
        return parent::current();
    }

    public function printAnyTranslation(): void
    {
        $this->rewind();
        while ($this->valid()) {
            print_r($this->current()->anyTranslation() . PHP_EOL);
            $this->next();
        }
    }

    public function printAllTranslations(): void
    {
        $this->rewind();
        while ($this->valid()) {
            print_r($this->current()->allTranslations() . PHP_EOL);
            $this->next();
        }
    }

    public function printMap(): void
    {
        $this->rewind();
        while ($this->valid()) {
            print_r($this->current()->word() . ': ' . $this->current()->allTranslations() . PHP_EOL);
            $this->next();
        }
    }
}
