<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelacionSolicitudes extends AbstractMigration
{
    public function up()
    {

        $solicitudes = $this->table('solicitudes');
        $solicitudes->addForeignKey(['id_categoria'],'categorias',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_categoriaSol'])
                    ->addForeignKey(['id_requerimiento'],'requerimientos',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_requerimientoSol'])
                    ->addForeignKey(['id_condicion'],'condiciones',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_condicionSol'])
                    ->addForeignKey(['id_estatus'],'estatus',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_estatusSol'])
                    ->save();
    }
}
