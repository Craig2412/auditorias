<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelationAppointments extends AbstractMigration
{
    public function up()
    {

        $appointments = $this->table('appointments');
        $appointments   ->addForeignKey(['id_requirement'],'requirements',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_requirementAppointments'])
                        ->addForeignKey(['id_status'],'status',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_statusAppointments'])
                        ->addForeignKey(['id_format_appointments'],'format_appointments',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_format_appointmentsAppointments'])
                        ->save();
    }
}
