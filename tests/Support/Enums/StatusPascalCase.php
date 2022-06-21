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
            self::Pending => 'Await decision',
            self::Accepted => 'Recognized valid',
            self::Discarded => 'No longer useful',
            self::NoResponse => 'No response',
        };
    }
}
