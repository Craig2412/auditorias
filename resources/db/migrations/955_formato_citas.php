<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class FormatoCitas extends AbstractMigration
{
   
    public function change(): void
    {
        $formato_citas = $this->table('formato_citas');
        $formato_citas  ->addColumn('formato_cita', 'string', ['limit' => 100])
                      ->create();
    }
}
