<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Empresas extends AbstractMigration
{
    
    public function change(): void
    {
        $empresas = $this->table('empresas');
        $empresas ->addColumn('nombre', 'string', ['limit' => 100])
                  ->addColumn('rif', 'string',['limit' => 25])
                  ->addColumn('bufete', 'boolean')
                  ->create();
    }
}
