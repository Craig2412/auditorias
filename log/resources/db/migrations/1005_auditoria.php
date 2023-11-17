<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Auditoria extends AbstractMigration
{
    public function change(): void
    {
        $auditoria = $this->table('auditoria');
        $auditoria   ->addColumn('id_usuario', 'integer', ['signed' => false])
                    ->addColumn('id_rol', 'integer', ['signed' => false])
                    ->addColumn('accion', 'string', ['limit' => 500])
                    ->addColumn('created', 'datetime')
                    ->addColumn('updated', 'datetime', ['null' => true])

                    ->addIndex('id_usuario')
                    ->addIndex('id_rol')
                    ->create();


    }
}
