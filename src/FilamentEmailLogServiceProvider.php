<?php

namespace Ramnzys\FilamentEmailLog;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Ramnzys\FilamentEmailLog\Commands\FilamentEmailLogCommand;

class FilamentEmailLogServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-email-log')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_filament-email-log_table')
            ->hasCommand(FilamentEmailLogCommand::class);
    }
}
