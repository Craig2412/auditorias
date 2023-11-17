<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Solicitudes extends AbstractMigration
{

    public function change(): void
    {
        $solicitudes = $this->table('solicitudes');
        $solicitudes       ->addColumn('num_solicitud', 'string', ['limit' => 10] , ['unique' => true])
                        ->addColumn('num_registro', 'string', ['limit' => 7])
                        ->addColumn('descripcion', 'string', ['limit' => 500])
                        ->addColumn('respuesta', 'string', ['limit' => 500])
                        ->addColumn('id_categoria', 'integer', ['signed' => false])
                        ->addColumn('id_requerimiento', 'integer', ['signed' => false])
                        ->addColumn('id_condicion', 'integer', ['signed' => false])
                        ->addColumn('id_estado', 'integer', ['signed' => false])
                        ->addColumn('created', 'datetime')
                        ->addColumn('updated', 'datetime', ['null' => true])

                        ->addIndex('num_solicitud', ['unique' => true])
                        ->addIndex('id_categoria')
                        ->addIndex('id_requerimiento')
                        ->addIndex('id_condicion')
                        ->addIndex('id_estado')
                        ->create();
    }
}
