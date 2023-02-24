<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Groupings extends AbstractMigration
{
    public function change(): void
    {
        $groupings = $this->table('groupings');
        $groupings   ->addColumn('grouping', 'string', ['limit' => 100])
                        ->create();
    }
}
