<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Workers extends AbstractMigration
{
    public function change(): void
    {
        $workers = $this->table('workers');
        $workers        ->addColumn('amount_requirements', 'integer')
                        ->addColumn('id_charge', 'integer', ['signed' => false])
                        ->addColumn('id_user', 'integer', ['signed' => false])
                        ->addColumn('id_status', 'integer', ['signed' => false])                        
                        ->addColumn('id_deparment', 'integer', ['signed' => false])                        
                        ->addColumn('created', 'datetime')
                        ->addColumn('updated', 'datetime', ['null' => true])

                        ->addIndex('id_charge')
                        ->addIndex('id_user')
                        ->addIndex('id_status')
                        ->addIndex('id_deparment')
                        ->create();
    }
}
