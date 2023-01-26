<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelacionAuditoria extends AbstractMigration
{
    public function up()
    {

        $auditoria = $this->table('auditoria');
        $auditoria->addForeignKey(['id_user'],'usuarios',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_userAudits'])
                  ->addForeignKey(['id_rol'],'roles',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_rolAudits'])
                  ->save();  
    }
}
