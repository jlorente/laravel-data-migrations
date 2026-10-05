<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

namespace Jlorente\DataMigrations\Console\Commands;

use Illuminate\Database\Console\Migrations\InstallCommand as BaseInstallCommand;

/**
 * InstallCommand class.
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
class InstallCommand extends BaseInstallCommand
{

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the data migration repository';

    /**
     * Rename the command after Laravel resolves its inherited name or signature.
     */
    protected function configure(): void
    {
        parent::configure();

        $this->setName('migrate-data:install');
    }

}
