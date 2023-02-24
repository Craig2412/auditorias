<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelationAudit extends AbstractMigration
{
    public function up()
    {

        $audit = $this->table('audits');
        $audit    ->addForeignKey(['id_user'],'users',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_userAudits'])
                  ->addForeignKey(['id_role'],'roles',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_roleAudits'])
                  ->save();  
    }
}
