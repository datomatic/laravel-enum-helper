# Changelog

All notable changes to `laravel-enum-helper` will be documented in this file.

## v2.1.1 - 2025-03-08

- fix annotations by @Carnicero90

## v2.1.0 - 2025-02-24

- Support for Laravel 12

## v2.0.2 - 2024-12-09

- fixed error of annotation command with folder with not enum files

## v2.0.1 - 2024-12-09

- fixed error of annotation command with string backed enum

## v2.0.0 - 2024-11-03

- enum-helper v2 dependency
- annotation generator command
- refactoring
- pint, larastan

## v1.1.1 - 2024-10-03

- fix phpDoc

## v1.1.0 - 2024-03-14

- Laravel 11 support

## v1.0.1 - 2023-02-15

Laravel 10 support

## v1.0.0 - 2022-09-09

- v1.0.0 release 🚀  🎉
- update requirements

## v0.7.0 - 2022-07-02

After migrating several projects with my fellow @RobertoNegro and listening to different opinions we have decided to simplify the package. From now on, I will consider a pure enum as a StringBackedEnum with names as values, so all ***AsSelect() methods will be replaced by ***ByValue() methods.

- added definition of `description()`, `descriptions()`, `descriptionsByName()`, `descriptionsByValue()` to improve code completion and static analysis
- removed all methods `***AsSelect()
- removed `NotBackedEnum` exception
- added support on `***ByValue()` methods also for pure enum using name instead value
- merged version number with datomatic/enum-helper

## v0.4.5 - 2022-07-01

- refactored `humanize` case string method
- added test to cover all cases
- refactored documentation

## v0.4.4 - 2022-06-30

- added a fallback to the case name on `description` "property"

## v0.4.3 - 2022-06-30

- improved the TranslationMissing exception message

## v0.4.2 - 2022-06-27

- fixed error with `IntBackedEnum`

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
