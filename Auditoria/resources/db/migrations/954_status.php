<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Status extends AbstractMigration
{
    public function change(): void
    {
        $status = $this->table('status');
        $status        ->addColumn('status', 'string', ['limit' => 100])
                        ->addColumn('id_grouping', 'integer', ['signed' => false])
                        ->addColumn('id_condition', 'integer', ['signed' => false])
                        ->addColumn('created', 'datetime')
                        ->addColumn('updated', 'datetime', ['null' => true])
                        
                        ->addIndex('id_grouping')
                        ->addIndex('id_condition')
                        ->create();
    }
}
