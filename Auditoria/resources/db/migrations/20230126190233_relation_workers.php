<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelationWorkers extends AbstractMigration
{
    public function change(): void
    {

        $workers = $this->table('workers');
        $workers   ->addForeignKey(['id_deparment'],'deparments',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_deparmentWorker'])
                        ->addForeignKey(['id_charge'],'charges',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_chargeWorker'])
                        ->addForeignKey(['id_user'],'users',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_userWorker'])
                        ->addForeignKey(['id_status'],'status',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_statusWorker'])
                        ->save();
    }
}
