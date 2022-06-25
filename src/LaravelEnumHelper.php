<?php

declare(strict_types=1);

namespace Datomatic\LaravelEnumHelper;

use Datomatic\EnumHelper\EnumHelper;
use Datomatic\EnumHelper\Exceptions\UndefinedCase;
use Datomatic\EnumHelper\Traits\EnumProperties;
use Datomatic\LaravelEnumHelper\Exceptions\TranslationMissing;
use Illuminate\Support\Str;

trait LaravelEnumHelper
{
    use EnumProperties;
    use EnumHelper {
        __callStatic as callStatic;
    }

    /**
     * Magic method to return a translation.
     */
    public function __call(string $method, array $parameters): string
    {
        $translateUniquePath = self::translateUniquePath($method, $this());

        $translation = __($translateUniquePath, [], $parameters[0] ?? null);

        if ($method === 'description'
            && Str::of($translation)->startsWith($translateUniquePath)) {
            $translation = __(self::translateUniqueFallbackPath($this()), [], $parameters[0] ?? null);
        }

        if (Str::of($translation)->startsWith(self::translateBaseUniquePath())) {
            throw new TranslationMissing(self::class, $method);
        }

        return $translation;
    }

    protected static function translateBaseUniquePath(): string
    {
        return 'enums.' . static::class;
    }

    protected static function translateUniquePath(string $method, string $value): string
    {
        return self::translateBaseUniquePath() . '.' . $method . '.' . $value;
    }

    protected static function translateUniqueFallbackPath(string $value): string
    {
        return self::translateBaseUniquePath() . '.' . $value;
    }

    public static function __callStatic(string $method, array $parameters): int|string|array
    {
        try {
            return self::callStatic($method, $parameters);
        } catch (UndefinedCase) {
        }

        $results = [];
        $args = [$parameters[0] ?? null, $parameters[1] ?? null];

        if ($singularMethod = self::getSingularIfEndsWith($method, 'ByName')) {
            $results = static::dynamicByKey('name', $singularMethod, ...$args);
        } elseif ($singularMethod = self::getSingularIfEndsWith($method, 'ByValue')) {
            $results = static::dynamicByKey('value', $singularMethod, ...$args);
        } elseif ($singularMethod = self::getSingularIfEndsWith($method, 'AsSelect')) {
            $results = static::dynamicAsSelect($singularMethod, ...$args);
        } elseif ($singularMethod = Str::singular($method)) {
            $results = static::dynamicList($singularMethod, ...$args);
        }

        return $results;
    }

    private static function getSingularIfEndsWith(string $method, string $string): ?string
    {
        if (Str::of($method)->endsWith($string)) {
            return Str::singular(Str::of($method)->replaceLast($string, ''));
        }

        return null;
    }
}
