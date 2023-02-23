<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelationDomainHasRole extends AbstractMigration
{
   
    public function change(): void
    {
        $table = $this->table('domain_has_role');
        $table   ->addForeignKey(['id_role'],'roles',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_rolePermiDom'])
                        ->save();
    }
}
