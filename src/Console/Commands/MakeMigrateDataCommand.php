<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

namespace Jlorente\DataMigrations\Console\Commands;

use Illuminate\Database\Console\Migrations\MigrateMakeCommand;
use Jlorente\DataMigrations\Console\Traits\DataMigrationCommandTrait;

/**
 * MakeMigrateDataCommand class.
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
class MakeMigrateDataCommand extends MigrateMakeCommand
{

    use DataMigrationCommandTrait;

    protected $signature = 'make:data-migration {name : The name of the migration.}
        {--create= : The table to be created.}
        {--table= : The table to migrate.}
        {--path= : The location where the migration file should be created.}
        {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
        {--fullpath : Output the full path of the migration}';
    protected $description = 'Create a new data migration file';

}
