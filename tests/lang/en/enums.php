<?php

declare(strict_types=1);

use Datomatic\LaravelEnumHelper\Tests\Support\Enums\Status;
use Datomatic\LaravelEnumHelper\Tests\Support\Enums\StatusFallbackLocale;
use Datomatic\LaravelEnumHelper\Tests\Support\Enums\StatusInt;
use Datomatic\LaravelEnumHelper\Tests\Support\Enums\StatusPascalCaseWithoutTranslation;
use Datomatic\LaravelEnumHelper\Tests\Support\Enums\StatusString;

return [
    Status::class => [
        'PENDING' => 'Await decision',
        'ACCEPTED' => 'Recognized valid',
        'DISCARDED' => 'No longer useful',
        'NO_RESPONSE' => 'No response',

        'excerpt' => [
            'PENDING' => 'asdkj dskjdsa dkjsa ksjd sadask',
            'ACCEPTED' => 'ls klsa dlksa dlksa salk salk',
            'DISCARDED' => 'ksalsa ld djks jjdk skjd j',
            'NO_RESPONSE' => 'as dklasd asldldlasd',
        ],
        'multipleWordsExcerpt' => [
            'PENDING' => 'asdkj dskjdsa dkjsa ksjd sadask',
            'ACCEPTED' => 'ls klsa dlksa dlksa salk salk',
            'DISCARDED' => 'ksalsa ld djks jjdk skjd j',
            'NO_RESPONSE' => 'as dklasd asldldlasd',
        ],
        'multiple_words_excerpt' => [
            'PENDING' => 'asdkj dskjdsa dkjsa ksjd sadask',
            'ACCEPTED' => 'ls klsa dlksa dlksa salk salk',
            'DISCARDED' => 'ksalsa ld djks jjdk skjd j',
            'NO_RESPONSE' => 'as dklasd asldldlasd',
        ],
        'news' => [
            'PENDING' => 'news PENDING',
            'ACCEPTED' => 'news ACCEPTED',
            'DISCARDED' => 'news DISCARDED',
            'NO_RESPONSE' => 'news NO_RESPONSE',
        ],
    ],
    StatusInt::class => [
        StatusInt::pending() => 'Await decision',
        StatusInt::accepted() => 'Recognized valid',
        StatusInt::discarded() => 'No longer useful',
        StatusInt::noResponse() => 'No response',
    ],
    StatusFallbackLocale::class => [
        StatusFallbackLocale::pending() => 'FB Await decision',
        StatusFallbackLocale::accepted() => 'FB Recognized valid',
        StatusFallbackLocale::discarded() => 'FB No longer useful',
        StatusFallbackLocale::noResponse() => 'FB No response',
    ],
    StatusPascalCaseWithoutTranslation::class => [
        'description' => [
            StatusPascalCaseWithoutTranslation::pending() => 'Await decision',
            StatusPascalCaseWithoutTranslation::accepted() => 'Recognized valid',
            StatusPascalCaseWithoutTranslation::discarded() => 'No longer useful',
        ],
    ],
    StatusString::class => [
        'description' => [
            StatusString::pending() => 'Await decision',
            StatusString::accepted() => 'Recognized valid',
            StatusString::discarded() => 'No longer useful',
            StatusString::noResponse() => 'No response',
        ],
        'excerpt' => [
            StatusString::pending() => 'asdkj dskjdsa dkjsa ksjd sadask',
            StatusString::accepted() => 'ls klsa dlksa dlksa salk salk',
            StatusString::discarded() => 'ksalsa ld djks jjdk skjd j',
            StatusString::noResponse() => 'as dklasd asldldlasd',
        ],
    ],
];
