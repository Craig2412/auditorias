<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelationRequirements extends AbstractMigration
{
    public function up()
    {

        $requirements = $this->table('requirements');
        $requirements   ->addForeignKey(['id_format_appointment'],'format_appointments',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_format_appointmentRequirements'])
                        ->addForeignKey(['id_user'],'users',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_userRequirements'])
                        ->addForeignKey(['id_condition'],'conditions',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_conditionRequirements'])
                        ->addForeignKey(['id_worker'],'workers',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_workerRequirements'])
                        ->addForeignKey(['id_status'],'status',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_statusRequirements'])
                        ->save();
    }
}
