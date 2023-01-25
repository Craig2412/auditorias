<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Citas extends AbstractMigration
{
    public function change(): void
    {
        $citas = $this->table('citas');
        $citas   ->addColumn('fecha_cita', 'datetime')
                 ->addColumn('id_requerimiento', 'integer', ['signed' => false])
                 ->addColumn('id_estatus', 'integer',['signed' => false])
                 ->addColumn('created', 'datetime')
                 ->addColumn('updated', 'datetime', ['null' => true])

                 ->addIndex('id_requerimiento')
                 ->addIndex('id_estatus')
                 
                 ->addForeignKey(['id_requerimiento'],'requerimientos',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_requerimientoCita'])
                 ->addForeignKey(['id_estatus'],'estatus',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_estatusCita'])
                 ->create();
                
    }
   
}
