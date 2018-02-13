<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */
namespace Jlorente\DataMigrations\Console\Commands;

use Illuminate\Database\Console\Migrations\MigrateCommand;
use Illuminate\Database\Migrations\Migrator;
use Jlorente\DataMigrations\Console\Traits\DataMigrationCommandTrait;

/**
 * MigrateDataCommand class.
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
class MigrateDataCommand extends MigrateCommand
{

    use DataMigrationCommandTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate {--database= : The database connection to use.}
                {--force : Force the operation to run when in production.}
                {--path= : The path of migrations files to be executed.}
                {--pretend : Dump the SQL queries that would be run.}
                {--seed : Indicates if the seed task should be re-run.}
                {--step : Force the migrations to be run so they can be rolled back individually.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the data migrations';

    /**
     * Create a new data migration command instance.
     *
     * @param  \Illuminate\Database\Migrations\Migrator  $migrator
     * @return void
     */
    public function __construct(Migrator $migrator)
    {
        parent::__construct($migrator);
        $this->migrator = \App::make('migrator.data');
    }

}
