<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Configuracion extends AbstractMigration
{
    public function change(): void
    {
        $configuracion = $this->table('configuracion');
        $configuracion  ->addColumn('variable', 'string', ['limit' => 70])
                        ->addColumn('valor', 'string', ['limit' => 500])
                        ->addColumn('id_condicion', 'integer', ['signed' => false])
                        ->addColumn('created', 'datetime')
                        ->addColumn('updated', 'datetime', ['null' => true])
                        
                        ->addIndex('id_condicion')
                        ->create();
    }
}
