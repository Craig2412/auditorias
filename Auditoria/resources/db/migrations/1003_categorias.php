<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Categorias extends AbstractMigration
{
    public function change(): void
    {
        $categorias = $this->table('categorias');
        $categorias->addColumn('categoria', 'string', ['limit' => 500])
                   ->addColumn('id_condicion', 'integer', ['signed' => false])
                   ->addColumn('id_departamento', 'integer', ['signed' => false])
                   ->addColumn('created', 'datetime')
                   ->addColumn('updated', 'datetime', ['null' => true])

                   ->addIndex('id_departamento')
                   ->addIndex('id_condicion')
                   ->create();
    }
}
