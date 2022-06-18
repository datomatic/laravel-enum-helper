<?php

declare(strict_types=1);

use Datomatic\LaravelEnumHelper\Tests\Support\Enums\Status;
use Datomatic\LaravelEnumHelper\Tests\Support\Enums\StatusString;

return [
    Status::class => [
        'description' => [
            'PENDING' => 'Await decision',
            'ACCEPTED' => 'Recognized valid',
            'DISCARDED' => 'No longer useful',
            'NO_RESPONSE' => 'No response',
        ],
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
    StatusString::class => [
        'description' => [
            StatusString::PENDING->name => 'Await decision',
            StatusString::ACCEPTED->name => 'Recognized valid',
            StatusString::DISCARDED->name => 'No longer useful',
            StatusString::NO_RESPONSE->name => 'No response',
        ],
        'excerpt' => [
            'PENDING' => 'asdkj dskjdsa dkjsa ksjd sadask',
            'ACCEPTED' => 'ls klsa dlksa dlksa salk salk',
            'DISCARDED' => 'ksalsa ld djks jjdk skjd j',
            'NO_RESPONSE' => 'as dklasd asldldlasd',
        ],
    ],
];
