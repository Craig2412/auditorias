<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelacionAuditoria extends AbstractMigration
{
    public function up()
    {

        $audit = $this->table('auditoria');
        $audit    ->addForeignKey(['id_usuario'],'usuarios',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_usuarioAuditoria'])
                  ->addForeignKey(['id_rol'],'roles',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_rolAuditoria'])
                  ->save();  
    }
}
