<?php

declare(strict_types=1);

namespace Deutsch;

use MyCLabs\Enum\Enum;

/**
 * @method static GermanDefiniteArticle DER()
 * @method static GermanDefiniteArticle DIE()
 * @method static GermanDefiniteArticle DAS()
 */
final class GermanDefiniteArticle extends Enum
{
    private const DER = 'der';
    private const DIE = 'die';
    private const DAS = 'das';
}
