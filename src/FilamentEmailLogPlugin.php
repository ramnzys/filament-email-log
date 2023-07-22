<?php

namespace Ramnzys\FilamentEmailLog;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Ramnzys\FilamentEmailLog\Filament\Resources\EmailResource;

class FilamentEmailLogServiceProvider implements Plugin
{
    public function getId(): string
    {
        return FilamentEmailLogServiceProvider::$name;
    }

    public function register(Panel $panel): void
    {
        $panel->registerResources([
            EmailResource::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
    }
}