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
enum StatusPascalCase
{
    use LaravelEnumHelper;

    case Pending;

    case Accepted;

    case Discarded;

    case NoResponse;

    public function description(?string $lang = null): string
    {
        return match ($this) {
            self::Pending => 'PC Await decision',
            self::Accepted => 'PC Recognized valid',
            self::Discarded => 'PC No longer useful',
            self::NoResponse => 'PC No response',
        };
    }
}
