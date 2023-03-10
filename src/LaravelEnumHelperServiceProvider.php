<?php

declare(strict_types=1);

namespace Datomatic\LaravelEnumHelper;

use Datomatic\LaravelEnumHelper\Commands\EnumAnnotateCommand;
use Illuminate\Support\ServiceProvider;

class LaravelEnumHelperServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->bootCommands();
    }

    protected function bootCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                EnumAnnotateCommand::class,
            ]);
        }
    }
}
