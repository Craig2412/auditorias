<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Deparments extends AbstractMigration
{
    public function change(): void
    {
        $departments = $this->table('deparments');
        $departments  ->addColumn('deparment', 'string', ['limit' => 100])
                        ->addColumn('id_condition', 'integer', ['signed' => false])
                        ->addColumn('created', 'datetime')
                        ->addColumn('updated', 'datetime', ['null' => true])
                        
                        ->addIndex('id_condition')
                        ->create();
   }
}
