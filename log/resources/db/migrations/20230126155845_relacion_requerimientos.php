<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelacionRequerimientos extends AbstractMigration
{
    public function up()
    {

        $requerimientos = $this->table('requerimientos');
        $requerimientos   ->addForeignKey(['id_formato_cita'],'formato_citas',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_formato_citaRequerimiento'])
                        ->addForeignKey(['id_usuario'],'usuarios',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_usuarioRequerimiento'])
                        ->addForeignKey(['id_trabajador'],'usuarios',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_trabajadorRequerimiento'])
                        ->addForeignKey(['id_condicion'],'condiciones',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_condicionRequerimiento'])
                        ->addForeignKey(['id_estado'],'estados',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_estadoRequerimiento'])
                        ->save();
    }
}
