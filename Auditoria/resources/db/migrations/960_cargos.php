<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Cargos extends AbstractMigration
{
    public function change(): void
    {
        $cargos = $this->table('cargos');
        $cargos  ->addColumn('cargo', 'string', ['limit' => 100])
                 ->create();
    }
}
