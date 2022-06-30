<?php

declare(strict_types=1);

namespace Datomatic\LaravelEnumHelper\Exceptions;

use RuntimeException;

class TranslationMissing extends RuntimeException
{
    public function __construct(\UnitEnum $enum, string $method)
    {
        parent::__construct("Translation missing for '$method' property of " . get_class($enum) . "::$enum->name");
    }
}
