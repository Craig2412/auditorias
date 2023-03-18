<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class appointments extends AbstractMigration
{
    public function change(): void
    {
        $appointments = $this->table('appointments');
        $appointments   ->addColumn('appointment_date', 'datetime')
                        ->addColumn('id_requirement', 'integer', ['signed' => false] , ['unique' => true])
                        ->addColumn('id_status', 'integer',['signed' => false])
                        ->addColumn('id_format_appointments', 'integer',['signed' => false])
                        ->addColumn('created', 'datetime')
                        ->addColumn('updated', 'datetime', ['null' => true])

                        ->addIndex('id_format_appointments')
                        ->addIndex('id_requirement')
                        ->addIndex('id_status')
                        ->create();
    }
   
}
