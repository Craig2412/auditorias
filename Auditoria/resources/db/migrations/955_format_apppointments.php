<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class FormatApppointments extends AbstractMigration
{
   
    public function change(): void
    {
        $appoinments = $this->table('format_appointments');
        $appoinments  ->addColumn('format_appointment', 'string', ['limit' => 100])
                      ->create();
    }
}
