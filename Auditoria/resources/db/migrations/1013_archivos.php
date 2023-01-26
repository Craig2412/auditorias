<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Archivos extends AbstractMigration{
    
    public function change(): void{
        $archivos = $this->table('archivos');
        $archivos->addColumn('name', 'string', ['limit' => 500])
                 ->addColumn('url', 'string', ['limit' => 500])
                 ->addColumn('tipo_archivo', 'integer')
                 ->addColumn('id_requerimiento', 'integer', ['signed' => false])
                 ->addColumn('created', 'datetime')
                 ->addColumn('updated', 'datetime', ['null' => true])
                 
                 ->addIndex('id_requerimiento')
                        
                 ->addForeignKey(['id_requerimiento'],'requerimientos',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_requerimientoFile'])
                 ->create();
    }
}
