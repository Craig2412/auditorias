<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelationCategory extends AbstractMigration
{
    public function up()
    {

        $categories = $this->table('categories');
        $categories->addForeignKey(['id_deparment'],'deparments',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_deparmentCategory'])
                   ->addForeignKey(['id_condition'],'conditions',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_conditionCategory'])
                   ->save();
    }
}
