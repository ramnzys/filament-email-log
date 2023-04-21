<?php

namespace Ramnzys\FilamentEmailLog;

use Filament\PluginServiceProvider;
use Ramnzys\FilamentEmailLog\Filament\Resources\EmailResource;
use Ramnzys\FilamentEmailLog\Providers\EmailMessageServiceProvider;
use Spatie\LaravelPackageTools\Package;

class FilamentEmailLogServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-email-log';

    protected array $resources = [
        EmailResource::class,
    ];

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */

        parent::configurePackage($package);

        $package
            ->name('filament-email-log')
            ->hasConfigFile('filament-email-log')
            ->hasMigrations([
                'create_filament_email_log_table',
                'add_raw_and_debug_fields_to_filament_email_log_table',
            ]);

        $this->app->register(EmailMessageServiceProvider::class);
    }
    protected function getResources(): array
    {
        return [
            config('filament-email-log.resource_class') ?? EmailResource::class,
        ];
    }
}
