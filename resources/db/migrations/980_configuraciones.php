<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Configuraciones extends AbstractMigration
{
    public function change(): void
    {
        $configuraciones = $this->table('configuraciones');
        $configuraciones->addColumn('variable', 'string', ['limit' => 70])
                        ->addColumn('valor', 'string', ['limit' => 500])
                        ->addColumn('id_condicion', 'integer', ['signed' => false])
                        ->addColumn('created', 'datetime')
                        ->addColumn('updated', 'datetime', ['null' => true])
                        
                        ->addIndex('id_condicion')
                        ->create();
    }
}
