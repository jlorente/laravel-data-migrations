<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

namespace Jlorente\DataMigrations\Console\Commands;

use Illuminate\Database\Console\Migrations\RollbackCommand;
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
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rollback the last database data migration';

    /**
     * Rename the command after Laravel resolves its inherited name or signature.
     */
    protected function configure(): void
    {
        parent::configure();

        $this->setName('migrate-data:rollback');
    }

}
