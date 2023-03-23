<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Requests extends AbstractMigration
{

    public function change(): void
    {
        $requests = $this->table('requests');
        $requests       ->addColumn('num_request', 'integer')//En caso de querer implementar este sistema en patentes, se debe quitar la rstriccion
                        ->addColumn('num_registry', 'integer')//de 'unique' al num_requests y filtrar todo por el num_registry(nro_derecho)
                        ->addColumn('nombre_servicio', 'string', ['limit' => 500])
                        ->addColumn('approach', 'string', ['limit' => 500])
                        ->addColumn('response', 'string', ['limit' => 500])
                        ->addColumn('name', 'string', ['limit' => 100])
                        ->addColumn('id_category', 'integer', ['signed' => false])
                        ->addColumn('id_requirement', 'integer', ['signed' => false])
                        ->addColumn('id_condition', 'integer', ['signed' => false])
                        ->addColumn('id_status', 'integer', ['signed' => false])
                        ->addColumn('created', 'datetime')
                        ->addColumn('updated', 'datetime', ['null' => true])

                        ->addIndex('num_request', ['unique' => true])
                        ->addIndex('num_registry', ['unique' => true])
                        ->addIndex('id_category')
                        ->addIndex('id_requirement')
                        ->addIndex('id_condition')
                        ->addIndex('id_status')
                        ->create();
    }
}
