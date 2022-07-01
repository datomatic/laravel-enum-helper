<?php

declare(strict_types=1);

namespace Datomatic\LaravelEnumHelper\Tests\Support\Enums;

use Datomatic\LaravelEnumHelper\LaravelEnumHelper;

/**
 * @method static string pending()
 * @method static string accepted()
 * @method static string discarded()
 * @method static string noResponse()
 */
enum StatusPascalCaseWithoutTranslation
{
    use LaravelEnumHelper;

    case Pending;

    case Accepted;

    case Discarded;

    case NoResponse;
}
