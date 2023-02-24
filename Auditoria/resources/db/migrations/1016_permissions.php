<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Permissions extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('permissions');
        $table   ->addColumn('name', 'string', ['limit' => 50])
                 ->addColumn('guard_name', 'string', ['limit' => 50])
                 ->addColumn('created', 'datetime')
                 ->addColumn('updated', 'datetime', ['null' => true])
                 ->create();
    }
}
