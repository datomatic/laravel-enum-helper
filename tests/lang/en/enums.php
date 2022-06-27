<?php

declare(strict_types=1);

use Datomatic\LaravelEnumHelper\Tests\Support\Enums\Status;
use Datomatic\LaravelEnumHelper\Tests\Support\Enums\StatusInt;
use Datomatic\LaravelEnumHelper\Tests\Support\Enums\StatusPascalCase;
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
        StatusInt::Pending() => 'Await decision',
        StatusInt::Accepted() => 'Recognized valid',
        StatusInt::Discarded() => 'No longer useful',
        StatusInt::NoResponse() => 'No response',
    ],
    StatusPascalCase::class => [
        'description' => [
            StatusPascalCase::Pending() => 'Await decision',
            StatusPascalCase::Accepted() => 'Recognized valid',
            StatusPascalCase::Discarded() => 'No longer useful',
            StatusPascalCase::NoResponse() => 'No response',
        ],
    ],
    StatusString::class => [
        'description' => [
            StatusString::PENDING() => 'Await decision',
            StatusString::ACCEPTED() => 'Recognized valid',
            StatusString::DISCARDED() => 'No longer useful',
            StatusString::NO_RESPONSE() => 'No response',
        ],
        'excerpt' => [
            StatusString::PENDING() => 'asdkj dskjdsa dkjsa ksjd sadask',
            StatusString::ACCEPTED() => 'ls klsa dlksa dlksa salk salk',
            StatusString::DISCARDED() => 'ksalsa ld djks jjdk skjd j',
            StatusString::NO_RESPONSE() => 'as dklasd asldldlasd',
        ],
    ],
];
