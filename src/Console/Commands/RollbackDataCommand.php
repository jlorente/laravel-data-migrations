<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

namespace Jlorente\DataMigrations\Console\Commands;

use Illuminate\Database\Console\Migrations\RollbackCommand;
use Illuminate\Database\Migrations\Migrator;
use Jlorente\DataMigrations\Console\Traits\DataMigrationCommandTrait;

/**
 * RollbackDataCommand class.
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
class RollbackDataCommand extends RollbackCommand
{

    use DataMigrationCommandTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:rollback-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rollback the last database data migration';

    /**
     * Create a new data migration rollback command instance.
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
