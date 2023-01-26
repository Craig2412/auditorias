<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Condicion extends AbstractMigration
{
    public function change(): void
    {
        $condicion = $this->table('condiciones');
        $condicion->addColumn('condicion', 'string', ['limit' => 50])
                 ->create();
    }
}
