<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelacionArchivos extends AbstractMigration
{
    public function up()
    {
       
        $archivos = $this->table('archivos');
        $archivos->addForeignKey(['id_requerimiento'],'requerimientos',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_requerimientoFile'])
                 ->save();
    }
}
