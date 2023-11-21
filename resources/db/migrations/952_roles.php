<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Roles extends AbstractMigration
{
    public function change(): void
    {
        $roles = $this->table('roles');
        $roles   ->addColumn('rol', 'string', ['limit' => 100])
                 ->create();
    }
}
