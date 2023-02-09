<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Audits extends AbstractMigration
{
    public function change(): void
    {
        $audits = $this->table('audits');
        $audits   ->addColumn('id_user', 'integer', ['signed' => false])
                  ->addColumn('id_role', 'integer', ['signed' => false])
                  ->addColumn('action', 'string', ['limit' => 500])
                  ->addColumn('created', 'datetime')
                  ->addColumn('updated', 'datetime', ['null' => true])

                  ->addIndex('id_user')
                  ->addIndex('id_role')
                  ->create();


    }
}
