<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Requerimientos extends AbstractMigration
{
    public function change(): void
    {
        $requerimientos = $this->table('requerimientos');
        $requerimientos ->addColumn('id_formato_cita', 'integer', ['signed' => false])
                        ->addColumn('id_usuario', 'integer', ['signed' => false])
                        ->addColumn('id_condicion', 'integer', ['signed' => false])
                        ->addColumn('id_estado', 'integer', ['signed' => false])
                        ->addColumn('id_trabajador', 'integer', ['signed' => false])
                        ->addColumn('created', 'datetime')
                        ->addColumn('updated', 'datetime', ['null' => true])

                        ->addIndex('id_formato_cita')
                        ->addIndex('id_usuario')
                        ->addIndex('id_condicion')
                        ->addIndex('id_estado')
                        ->addIndex('id_trabajador')
                        ->create();
    }
}
