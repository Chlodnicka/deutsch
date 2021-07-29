<?php

use Deutsch\CsvRowsRandomizer;
use Deutsch\File;
use Deutsch\WordTranslationFactory;

require dirname(__DIR__) . '/vendor/autoload.php';


const WORDS_FILE = 'worter.csv';

print_r('START' . PHP_EOL);

const POLISH = 'POLISH';
const GERMAN = 'GERMAN';

const YES = 'y';
const NO = 'n';

$translateFrom = $argv[1] === 'p' ? POLISH : GERMAN;

$file = File::create(__DIR__ . '/../resources/' . WORDS_FILE);
$drawnRows = (new CsvRowsRandomizer())->draw($file, 30);
$wordsTranslationsMaps = (new WordTranslationFactory())->create($drawnRows);

if ($translateFrom === GERMAN) {
    $wordsTranslationsMaps->printWords();
    print_r('--------------' . PHP_EOL);
} else {
    $wordsTranslationsMaps->printAnyTranslation();
    print_r('--------------' . PHP_EOL);
    print_r('Need help?(y/n)' . PHP_EOL);
    $shouldDisplayAll = rtrim(fgets(STDIN));
    if ($shouldDisplayAll === YES) {
        $wordsTranslationsMaps->printAllTranslations();
    }
    print_r('--------------' . PHP_EOL);
}

$displayMap = rtrim(fgets(STDIN));
$wordsTranslationsMaps->printMap();
print_r('--------------' . PHP_EOL);

print_r('FINISH' . PHP_EOL);
