<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelacionCitas extends AbstractMigration
{
    public function up()
    {

        $citas = $this->table('citas');
        $citas  ->addForeignKey(['id_requerimiento'],'requerimientos',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_requerimientoCita'])
                ->addForeignKey(['id_estatus'],'estatus',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_estatusCita'])
                ->save();
    }
}
