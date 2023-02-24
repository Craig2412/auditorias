<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Companies extends AbstractMigration
{
    
    public function change(): void
    {
        $empresas = $this->table('companies');
        $empresas ->addColumn('name', 'string', ['limit' => 100])
                  ->addColumn('rif', 'string',['limit' => 25])
                  ->addColumn('signature', 'boolean')
                  ->create();
    }
}
