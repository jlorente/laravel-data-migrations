<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

namespace Jlorente\DataMigrations\Console\Traits;

/**
 * DataMigrationCommandTrait trait.
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
trait DataMigrationCommandTrait
{

    /**
     * Get the path to the migration directory.
     *
     * @return string
     */
    protected function getMigrationPath()
    {
        return $this->laravel->databasePath() . DIRECTORY_SEPARATOR . 'data_migrations';
    }

}
