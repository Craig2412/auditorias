<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Areas extends AbstractMigration
{
    public function change(): void
    {
        $areas = $this->table('areas');
        $areas ->addColumn('area', 'string' , ['limit' => 300])
               ->create();
    }
}
