<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Bufetes extends AbstractMigration
{
    
    public function change(): void
    {
        $bufetes = $this->table('bufetes');
        $bufetes ->addColumn('nombre', 'string', ['limit' => 100])
                 ->addColumn('rif', 'string',['limit' => 25])
                 ->create();
    }
}
