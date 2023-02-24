<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelationStatus extends AbstractMigration
{
    public function up()
    {

        $status = $this->table('status');
        $status ->addForeignKey(['id_groupings'],'groupings',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_groupingsStatus'])
                ->addForeignKey(['id_condition'],'conditions',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_conditionStatud'])
                ->save();
    }
}
