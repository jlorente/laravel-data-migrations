<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

namespace Jlorente\DataMigrations;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Migrations\Migrator;
use Jlorente\DataMigrations\Console\Commands\InstallCommand as MigrateInstallCommand;
use Jlorente\DataMigrations\Console\Commands\MakeMigrateDataCommand;
use Jlorente\DataMigrations\Console\Commands\MigrateDataCommand;
use Jlorente\DataMigrations\Console\Commands\RollbackDataCommand;
use Jlorente\DataMigrations\Repositories\DatabaseDataMigrationRepository;

/**
 * DataMigrationsServiceProvider class.
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
class DataMigrationsServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        'MigrateData' => 'command.migrate-data'
        , 'MigrateDataInstall' => 'command.migrate-data.install'
        , 'MigrateDataRollback' => 'command.migrate-data.rollback'
    ];

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $devCommands = [
        'MigrateDataMake' => 'command.migrate-data.make'
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerConfig();
        }
    }

    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/data-migrations.php' => config_path('data-migrations.php'),
                ], 'data-migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRepository();
        $this->registerMigrator();
        $this->registerArtisanCommands();

        $this->commands($this->provides());
    }

    protected function registerRepository()
    {
        $this->app->singleton('migration.data.repository', function ($app) {
            $table = config('data-migrations.table');

            return new DatabaseDataMigrationRepository($app['db'], $table);
        });
    }

    protected function registerMigrator()
    {
        $this->app->singleton('migrator.data', function($app) {
            $repository = $app['migration.data.repository'];

            return new Migrator($repository, $app['db'], $app['files']);
        });
    }

    protected function registerArtisanCommands()
    {
        $this->app->singleton('command.migrate-data', function ($app) {
            return new MigrateDataCommand($app['migrator.data']);
        });
        $this->app->singleton('command.migrate-data.install', function ($app) {
            return new MigrateInstallCommand($app['migration.data.repository']);
        });
        $this->app->singleton('command.migrate-data.rollback', function ($app) {
            return new RollbackDataCommand($app['migrator.data']);
        });
        $this->app->singleton('command.migrate-data.make', function ($app) {
            // Once we have the migration creator registered, we will create the command
            // and inject the creator. The creator is responsible for the actual file
            // creation of the migrations, and may be extended by these developers.
            $creator = $app['migration.creator'];

            $composer = $app['composer'];

            return new MakeMigrateDataCommand($creator, $composer);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array_merge(array_values($this->commands), array_values($this->devCommands));
    }

}
