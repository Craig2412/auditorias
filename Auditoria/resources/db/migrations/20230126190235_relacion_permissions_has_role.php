<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelacionPermissionsHasRole extends AbstractMigration
{
    public function change(): void
    {

        $table = $this->table('permissions_has_role');
        $table   ->addForeignKey(['id_permissions'],'permissions',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_permiRole'])
                 ->addForeignKey(['id_role'],'roles',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_rolePermi'])
                        ->save();
    }
}
