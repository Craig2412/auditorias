<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class PermissionsHasRole extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('permissions_has_role');
        $table   ->addColumn('id_permissions', 'integer', ['signed' => false])
                 ->addColumn('id_role', 'integer', ['signed' => false])

                 ->addIndex('id_permissions')
                 ->addIndex('id_role')
                 ->create();
    }
}
