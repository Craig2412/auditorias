<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelacionEstados extends AbstractMigration
{
    public function up()
    {

        $estados = $this->table('estados');
        $estados ->addForeignKey(['id_agrupacion'],'agrupaciones',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_agrupacionEstado'])
                ->addForeignKey(['id_condicion'],'condiciones',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_condicionEstado'])
                ->save();
    }
}
