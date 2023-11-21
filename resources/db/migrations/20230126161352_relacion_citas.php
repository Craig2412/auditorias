<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelacionCitas extends AbstractMigration
{
    public function up()
    {

        $citas = $this->table('citas');
        $citas   ->addForeignKey(['id_requerimiento'],'requerimientos',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_requerimientoCitas'])
                 ->addForeignKey(['id_estado'],'estados',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_estadoCitas'])
                 ->addForeignKey(['id_formato_cita'],'formato_citas',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_formato_citaCitas'])
                 ->addForeignKey(['id_condicion'],'condiciones',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_condicionCitas'])

                 ->save();
    }
}
