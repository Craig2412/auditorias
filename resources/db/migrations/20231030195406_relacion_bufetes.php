<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelacionBufetes extends AbstractMigration
{
    
    public function change(): void
    {

        $bufetes = $this->table('bufetes');
        $bufetes->addForeignKey(['id_condicion'],'condiciones',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_condicionBuefetes'])
                ->save();
    }
}
