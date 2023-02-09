<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Conditions extends AbstractMigration
{
    public function change(): void
    {
        $conditions = $this->table('conditions');
        $conditions->addColumn('condition', 'string', ['limit' => 50])
                   ->create();
    }
}
