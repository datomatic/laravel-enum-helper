<?php

declare(strict_types=1);

namespace Datomatic\LaravelEnumHelper\Tests\Support\Enums;

enum DoesntUseEnumHelperTrait
{
    case FOO;
    case BAR;
}
