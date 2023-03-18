<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Requests extends AbstractMigration
{

    public function change(): void
    {
        $requests = $this->table('requests');
        $requests       ->addColumn('num_request', 'string', ['limit' => 500] , ['unique' => true])
                        ->addColumn('num_registry', 'string', ['limit' => 500])
                        ->addColumn('nombre_servicio', 'string', ['limit' => 500])
                        ->addColumn('approach', 'string', ['limit' => 500])
                        ->addColumn('response', 'string', ['limit' => 500])
                        ->addColumn('id_company_represented', 'integer', ['signed' => false])
                        ->addColumn('id_category', 'integer', ['signed' => false])
                        ->addColumn('id_requirement', 'integer', ['signed' => false])
                        ->addColumn('id_condition', 'integer', ['signed' => false])
                        ->addColumn('id_status', 'integer', ['signed' => false])
                        ->addColumn('created', 'datetime')
                        ->addColumn('updated', 'datetime', ['null' => true])

                        ->addIndex('num_request', ['unique' => true])
                        ->addIndex('id_company_represented')
                        ->addIndex('id_category')
                        ->addIndex('id_requirement')
                        ->addIndex('id_condition')
                        ->addIndex('id_status')
                        ->create();
    }
}
