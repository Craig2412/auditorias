<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Departamentos extends AbstractMigration
{
    public function change(): void
    {
        $departamentos = $this->table('departamentos');
        $departamentos  ->addColumn('departamento', 'string', ['limit' => 100])
                        ->addColumn('id_condicion', 'integer', ['signed' => false])
                        ->addColumn('created', 'datetime')
                        ->addColumn('updated', 'datetime', ['null' => true])
                        
                        ->addIndex('id_condicion')
                        ->create();
   }
}
