<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Auditoria extends AbstractMigration
{
    public function change(): void
    {
        $auditoria = $this->table('auditoria');
        $auditoria->addColumn('id_user', 'integer', ['signed' => false])
                  ->addColumn('id_rol', 'integer', ['signed' => false])
                  ->addColumn('accion', 'string', ['limit' => 500])
                  ->addColumn('created', 'datetime')
                  ->addColumn('updated', 'datetime', ['null' => true])

                  ->addIndex('id_user')
                  ->addIndex('id_rol')
                 
                  ->addForeignKey(['id_user'],'usuarios',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_userAudits'])
                  ->addForeignKey(['id_rol'],'roles',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_rolAudits'])
                  ->create();


    }
}
