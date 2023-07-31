<?php

namespace Ramnzys\FilamentEmailLog\Tests;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Filament\FilamentServiceProvider;
use Filament\Actions\ActionsServiceProvider;
use Filament\Forms\FormsServiceProvider;
use Filament\Notifications\NotificationsServiceProvider;
use Filament\Support\SupportServiceProvider;
use Filament\Tables\TablesServiceProvider;
use Filament\Widgets\WidgetsServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Schema\Blueprint;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Ramnzys\FilamentEmailLog\FilamentEmailLogServiceProvider;
use Ramnzys\FilamentEmailLog\Providers\EmailMessageServiceProvider;
use Ramnzys\FilamentEmailLog\Tests\Models\User;
use Ramnzys\FilamentEmailLog\Tests\Panels\TestPanelProvider;

class TestCase extends Orchestra
{
    protected User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Ramnzys\\FilamentEmailLog\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        $packageProviders = [
            BladeHeroiconsServiceProvider::class,
            BladeIconsServiceProvider::class,
            FilamentServiceProvider::class,
            FormsServiceProvider::class,
            LivewireServiceProvider::class,
            SupportServiceProvider::class,
            TablesServiceProvider::class,
            ActionsServiceProvider::class,
            WidgetsServiceProvider::class,

            EmailMessageServiceProvider::class,
            FilamentEmailLogServiceProvider::class,

            TestPanelProvider::class,
        ];

        if (class_exists(NotificationsServiceProvider::class)) {
            $packageProviders[] = NotificationsServiceProvider::class;
        }

        return $packageProviders;
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        $migration = include __DIR__.'/../database/migrations/create_filament_email_log_table.php.stub';
        $migration->up();

        $migration = include __DIR__.'/../database/migrations/add_raw_and_debug_fields_to_filament_email_log_table.php.stub';
        $migration->up();
    }

    /**
     * Set up the database.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function setUpDatabase($app)
    {
        $app['db']->connection()->getSchemaBuilder()->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('name');
        });

        $this->adminUser = User::create(['email' => 'admin@domain.com', 'name' => 'Admin']);

        //self::$migration->up();
    }
}
