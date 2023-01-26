<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelacionEstatus extends AbstractMigration
{
    public function up()
    {

        $estatus = $this->table('estatus');
        $estatus->addForeignKey(['id_agrupacion'],'agrupaciones',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_agrupacionSta'])
                ->addForeignKey(['id_condicion'],'condiciones',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_condicionSta'])
                ->save();
    }
}
