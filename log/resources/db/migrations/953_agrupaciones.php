<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Agrupaciones extends AbstractMigration
{
    public function change(): void
    {
        $agrupaciones = $this->table('agrupaciones');
        $agrupaciones   ->addColumn('agrupacion', 'string', ['limit' => 100])
                        ->create();
    }
}
