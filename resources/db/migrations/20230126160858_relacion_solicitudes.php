<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelacionSolicitudes extends AbstractMigration
{
    public function up()
    {

        $solicitudes = $this->table('solicitudes');
        $solicitudes   ->addForeignKey(['id_categoria'],'categorias',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_categoriaSolicitudes'])
                    ->addForeignKey(['id_requerimiento'],'requerimientos',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_requerimientoSolicitudes'])
                    ->addForeignKey(['id_condicion'],'condiciones',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_condicionSolicitudes'])
                    ->addForeignKey(['id_estado'],'estados',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_estadoSolicitudes'])
                    ->save();
    }
}
