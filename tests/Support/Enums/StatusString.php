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
enum StatusString: string
{
    use LaravelEnumHelper;

    case PENDING = 'P';

    case ACCEPTED = 'A';

    case DISCARDED = 'D';

    case NO_RESPONSE = 'N';

    public function color(): string
    {
        return match ($this) {
            self::PENDING => '#000000',
            self::ACCEPTED => '#0000FF',
            self::DISCARDED => '#FF0000',
            self::NO_RESPONSE => '#FFFFFF',
        };
    }

    // method name are both plural and singular
    public function news(): string
    {
        return match ($this) {
            self::PENDING => 'news P',
            self::ACCEPTED => 'news A',
            self::DISCARDED => 'news D',
            self::NO_RESPONSE => 'news N',
        };
    }
}
