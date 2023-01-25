<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Solicitudes extends AbstractMigration
{

    public function change(): void
    {
        $solicitudes = $this->table('solicitudes');
        $solicitudes    ->addColumn('asunto', 'string', ['limit' => 500])
                        ->addColumn('descripcion', 'string', ['limit' => 500])
                        ->addColumn('nro_solicitud', 'string', ['limit' => 500])
                        ->addColumn('nro_tramite', 'string', ['limit' => 500])
                        ->addColumn('id_categoria', 'integer', ['signed' => false])
                        ->addColumn('id_requerimiento', 'integer', ['signed' => false])
                        ->addColumn('id_condicion', 'integer', ['signed' => false])
                        ->addColumn('id_estatus', 'integer', ['signed' => false])
                        ->addColumn('created', 'datetime')
                        ->addColumn('updated', 'datetime', ['null' => true])

                        ->addIndex('id_categoria')
                        ->addIndex('id_requerimiento')
                        ->addIndex('id_condicion')
                        ->addIndex('id_estatus')
                        
                        ->addForeignKey(['id_categoria'],'categorias',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_categoriaSol'])
                        ->addForeignKey(['id_requerimiento'],'requerimientos',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_requerimientoSol'])
                        ->addForeignKey(['id_condicion'],'condiciones',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_condicionSol'])
                        ->addForeignKey(['id_estatus'],'estatus',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_estatusSol'])
                        ->create();
    }
}
