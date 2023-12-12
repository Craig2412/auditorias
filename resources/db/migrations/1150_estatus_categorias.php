<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class EstatusCategorias extends AbstractMigration
{
    public function change(): void
    {
        $estatus_categorias = $this->table('estatus_categorias');
        $estatus_categorias->addColumn('estatus_categoria','string', ['limit' => 500])
                            ->addColumn('id_categoria', 'integer', ['signed' => false])
                            ->addColumn('created', 'datetime')
                            ->addColumn('updated', 'datetime', ['null' => true])

                            ->addIndex('id_categoria')
                            ->create();
    }
}
