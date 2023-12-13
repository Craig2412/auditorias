<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Paises extends AbstractMigration
{
    
    public function change(): void
    {
        $paises = $this->table('paises');
        $paises        ->addColumn('pais', 'string', ['limit' => 150])
                        ->addColumn('id_condicion', 'integer', ['signed' => false])
                        ->addColumn('created', 'datetime')
                        ->addColumn('updated', 'datetime', ['null' => true])
                        
                        ->addIndex('id_condicion')
                        ->create();
    }
}
