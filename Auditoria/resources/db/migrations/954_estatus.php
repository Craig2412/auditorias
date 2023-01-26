<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Estatus extends AbstractMigration
{
    public function change(): void
    {
        $estatus = $this->table('estatus');
        $estatus        ->addColumn('estatus', 'string', ['limit' => 100])
                        ->addColumn('id_agrupacion', 'integer', ['signed' => false])
                        ->addColumn('id_condicion', 'integer', ['signed' => false])
                        ->addColumn('created', 'datetime')
                        ->addColumn('updated', 'datetime', ['null' => true])
                        
                        ->addIndex('id_agrupacion')
                        ->addIndex('id_condicion')
                        ->create();
    }
}
