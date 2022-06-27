<?php

declare(strict_types=1);

use Datomatic\LaravelEnumHelper\Tests\Support\Enums\Status;
use Datomatic\LaravelEnumHelper\Tests\Support\Enums\StatusInt;
use Datomatic\LaravelEnumHelper\Tests\Support\Enums\StatusString;

return [
    Status::class => [
        'PENDING' => 'In attesa',
        'ACCEPTED' => 'Accettato',
        'DISCARDED' => 'Rifiutato',
        'NO_RESPONSE' => 'Nessuna Risposta',

        'excerpt' => [
            'PENDING' => 'ITA asdkj dskjdsa dkjsa ksjd sadask',
            'ACCEPTED' => 'ITA ls klsa dlksa dlksa salk salk',
            'DISCARDED' => 'ITA ksalsa ld djks jjdk skjd j',
            'NO_RESPONSE' => 'ITA as dklasd asldldlasd',
        ],
        'news' => [
            'PENDING' => 'ITA news PENDING',
            'ACCEPTED' => 'ITA news ACCEPTED',
            'DISCARDED' => 'ITA news DISCARDED',
            'NO_RESPONSE' => 'ITA news NO_RESPONSE',
        ],
    ],
    StatusString::class => [
        'description' => [
            'P' => 'In attesa',
            'A' => 'Accettato',
            'D' => 'Rifiutato',
            'N' => 'Nessuna Risposta',
        ],
        'excerpt' => [
            'P' => 'ITA asdkj dskjdsa dkjsa ksjd sadask',
            'A' => 'ITA ls klsa dlksa dlksa salk salk',
            'D' => 'ITA ksalsa ld djks jjdk skjd j',
            'N' => 'ITA as dklasd asldldlasd',
        ],
    ],
    StatusInt::class => [
        0 => 'In attesa',
        1 => 'Accettato',
        2 => 'Rifiutato',
        3 => 'Nessuna Risposta',
    ],
];
