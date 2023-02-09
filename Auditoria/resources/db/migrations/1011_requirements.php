<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Requirements extends AbstractMigration
{
    public function change(): void
    {
        $requirements = $this->table('requirements');
        $requirements   ->addColumn('amount_requests', 'integer')
                        ->addColumn('id_format_appointment', 'integer', ['signed' => false])
                        ->addColumn('id_user', 'integer', ['signed' => false])
                        ->addColumn('id_condition', 'integer', ['signed' => false])
                        ->addColumn('id_status', 'integer', ['signed' => false])
                        ->addColumn('id_worker', 'integer', ['signed' => false])
                        ->addColumn('created', 'datetime')
                        ->addColumn('updated', 'datetime', ['null' => true])

                        ->addIndex('id_format_appointment')
                        ->addIndex('id_user')
                        ->addIndex('id_condition')
                        ->addIndex('id_status')
                        ->addIndex('id_worker')
                        ->create();
    }
}
