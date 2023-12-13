<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class EstadosPaises extends AbstractMigration
{
 
    public function change(): void
    {
        $estados_paises = $this->table('estados_paises');
        $estados_paises ->addColumn('estado_pais', 'string', ['limit' => 150])
                        ->addColumn('id_pais', 'integer', ['signed' => false])
                        ->addColumn('id_condicion', 'integer', ['signed' => false])
                        ->addColumn('created', 'datetime')
                        ->addColumn('updated', 'datetime', ['null' => true])
                        
                        ->addIndex('id_pais')
                        ->addIndex('id_condicion')
                        ->create();
    }
}
