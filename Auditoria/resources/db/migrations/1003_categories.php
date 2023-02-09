<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Categories extends AbstractMigration
{
    public function change(): void
    {
        $categories = $this->table('categories');
        $categories->addColumn('category', 'string', ['limit' => 500])
                   ->addColumn('id_condition', 'integer', ['signed' => false])
                   ->addColumn('id_deparment', 'integer', ['signed' => false])
                   ->addColumn('created', 'datetime')
                   ->addColumn('updated', 'datetime', ['null' => true])

                   ->addIndex('id_deparment')
                   ->addIndex('id_condition')
                   ->create();
    }
}
