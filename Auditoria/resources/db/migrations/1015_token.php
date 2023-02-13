<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Token extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $tokens = $this->table('tokens');
        $tokens   ->addColumn('token', 'string', ['limit' => 1500])
                 ->addColumn('id_user', 'integer', ['signed' => false])
                 ->addColumn('created', 'datetime')
                 ->addColumn('updated', 'datetime', ['null' => true])

                 ->addIndex('id_user')
                 ->create();
    }
}
