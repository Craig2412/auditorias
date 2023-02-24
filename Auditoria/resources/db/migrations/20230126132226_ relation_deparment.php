<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelationDeparment extends AbstractMigration
{
    public function up()
    {   
        
        $departments = $this->table('departments');
        $departments->addForeignKey(['id_condition'],'conditions',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_conditionDepartments'])
                    ->save();
    }
}
