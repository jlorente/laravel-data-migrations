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
use Jlorente\DataMigrations\Repositories\DataMigrationRepository;

/**
 * DataMigrationsServiceProvider class.
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
class DataMigrationsServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerMigrations();
            $this->registerConfig();
        }
    }

    protected function registerMigrations()
    {
        $this->publishes([
            __DIR__ . '/../assets/migrations' => database_path('migrations'),
                ], 'data-migrations');
    }

    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../assets/config/data-migrations.php' => config_path('data-migrations.php'),
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
    }

    protected function registerRepository()
    {
        $this->app->singleton('migration.data.repository', function ($app) {
            $table = $app['config']['data-migrations']['migrations_data'];

            return new DataMigrationRepository($app['db'], $table);
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
        $this->commands([
            \Jlorente\DataMigrations\Console\Commands\MakeMigrateDataCommand::class,
            \Jlorente\DataMigrations\Console\Commands\MigrateDataCommand::class,
            \Jlorente\DataMigrations\Console\Commands\RollbackDataCommand::class,
        ]);
    }

}
