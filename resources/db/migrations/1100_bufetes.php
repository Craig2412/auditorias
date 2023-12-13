<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Bufetes extends AbstractMigration
{
    
    public function change(): void
    {
        $bufetes = $this->table('bufetes');
        $bufetes ->addColumn('nombre_bufete', 'string', ['limit' => 300])
                 ->addColumn('rif', 'string' , ['limit' => 15])
                 ->addColumn('correo', 'string' , ['limit' => 100])
                 ->addColumn('telefono', 'string' , ['limit' => 11])        
                 ->addColumn('id_condicion', 'integer', ['signed' => false])

                 ->addColumn('created', 'datetime')
                 ->addColumn('updated', 'datetime', ['null' => true])
                 ->addIndex('id_condicion')

                 
                 ->create();
    }
}
