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
enum Status
{
    use LaravelEnumHelper;

    case PENDING;

    case ACCEPTED;

    case DISCARDED;

    case NO_RESPONSE;

    public function color(): string
    {
        return match ($this) {
            self::PENDING => '#000000',
            self::ACCEPTED => '#0000FF',
            self::DISCARDED => '#FF0000',
            self::NO_RESPONSE => '#FFFFFF',
        };
    }

    public function multipleColor(): array
    {
        return match ($this) {
            self::PENDING => ['#000000', '#000001'],
            self::ACCEPTED => ['#0000FF', '#0000F1'],
            self::DISCARDED => ['#FF0000', '#FF0001'],
            self::NO_RESPONSE => ['#FFFFFF', '#FFFFF1'],
        };
    }
}
