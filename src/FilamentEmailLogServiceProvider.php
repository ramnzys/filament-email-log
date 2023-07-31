<?php

namespace Ramnzys\FilamentEmailLog;

use Ramnzys\FilamentEmailLog\Providers\EmailMessageServiceProvider;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentEmailLogServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-email-log';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name(static::$name)
            ->hasConfigFile('filament-email-log')
            ->hasViews()
            ->hasMigrations([
                'create_filament_email_log_table',
                'add_raw_and_debug_fields_to_filament_email_log_table',
            ]);

        $this->app->register(EmailMessageServiceProvider::class);
    }
}
