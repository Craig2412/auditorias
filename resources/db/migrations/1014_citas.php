<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Citas extends AbstractMigration
{
    public function change(): void
    {
        $citas = $this->table('citas');
        $citas  ->addColumn('fecha_cita', 'datetime')
                ->addColumn('id_requerimiento', 'integer', ['signed' => false])
                ->addColumn('id_estado', 'integer',['signed' => false])
                ->addColumn('id_formato_cita', 'integer',['signed' => false])
                ->addColumn('id_condicion', 'integer', ['signed' => false])
                ->addColumn('created', 'datetime')
                ->addColumn('updated', 'datetime', ['null' => true])

                ->addIndex('id_formato_cita')
                ->addIndex('id_condicion')
                ->addIndex('id_requerimiento', ['unique' => true])
                ->addIndex('id_estado')
                ->addIndex('fecha_cita', ['unique' => true])
                ->create();
    }
}
