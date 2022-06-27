# Changelog

All notable changes to `laravel-enum-helper` will be documented in this file.

## v0.4.1 - 2022-06-27

refactoring by @eppak

## v0.4.0 - 2022-06-25

- changed the translation key from `name` to `name/value` for using the more comfortable invokable functionality on enums.php
- added a translation fallback for description property translations

Example of new translation file

```php
// /lang/it/enums.php

return [
    // If you need to translate just the description property
    Status::class => [
        Status::PENDING() => 'In attesa', // using invokable trait functionality
        'ACCEPTED' => 'Accettato', // using the name of pure enum case
        'DISCARDED' => 'Rifiutato',
        'NO_RESPONSE' => 'Nessuna Risposta',
    ],
     // If you need to translate multiple properties (e.g. description, excerpt)
    StatusString::class => [
        'description' => [ // using invokable trait functionality
            StatusString::PENDING() => 'In attesa',
            StatusString::ACCEPTED() => 'Accettato',
            ...
        ],
        'excerpt' => [ // using the value of BackedEnum case
            "P" => 'In attesa',
            "A" => 'Accettato',
    ...


```
## v0.3.0 - 2022-06-21

- rename `LaravelEnum` trait in `LaravelEnumHelper`

## v0.2.1 - 2022-06-20

- fixed return of invokable static call on IntBackedEnum

## v0.2.0 - 2022-06-18

- permit to use of "property" name that has name both singular and plural
- updated banners

## v0.1.0 - 2022-06-15

First release 🚀
