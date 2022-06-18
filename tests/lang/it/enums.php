<?php

declare(strict_types=1);

use Datomatic\LaravelEnumHelper\Tests\Support\Enums\Status;
use Datomatic\LaravelEnumHelper\Tests\Support\Enums\StatusString;

return [
    Status::class => [
        'description' => [
            'PENDING' => 'In attesa',
            'ACCEPTED' => 'Accettato',
            'DISCARDED' => 'Rifiutato',
            'NO_RESPONSE' => 'Nessuna Risposta',
        ],
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
            'PENDING' => 'In attesa',
            'ACCEPTED' => 'Accettato',
            'DISCARDED' => 'Rifiutato',
            'NO_RESPONSE' => 'Nessuna Risposta',
        ],
        'excerpt' => [
            'PENDING' => 'ITA asdkj dskjdsa dkjsa ksjd sadask',
            'ACCEPTED' => 'ITA ls klsa dlksa dlksa salk salk',
            'DISCARDED' => 'ITA ksalsa ld djks jjdk skjd j',
            'NO_RESPONSE' => 'ITA as dklasd asldldlasd',
        ],
    ],
];
