<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Settings extends AbstractMigration
{
    public function change(): void
    {
        $setting = $this->table('settings');
        $setting        ->addColumn('variable', 'string', ['limit' => 70])
                        ->addColumn('value', 'string', ['limit' => 500])
                        ->addColumn('id_condition', 'integer', ['signed' => false])
                        ->addColumn('created', 'datetime')
                        ->addColumn('updated', 'datetime', ['null' => true])
                        
                        ->addIndex('id_condition')
                        ->create();
    }
}
