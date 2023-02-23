<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class DomainHasRole extends AbstractMigration
{
  
    public function change(): void
    {
        $table = $this->table('domain_has_role');
        $table   ->addColumn('domain', 'string',['limit' => 500])
                 ->addColumn('id_role', 'integer', ['signed' => false])

                 ->addIndex('id_role')
                 ->create();
    }
}
