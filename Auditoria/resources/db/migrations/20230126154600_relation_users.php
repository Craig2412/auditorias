<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelationUsers extends AbstractMigration
{
    public function up()
    {

        $usuarios = $this->table('users');
        $usuarios->addForeignKey(['id_role'],'roles',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_roleUsers'])
                 ->addForeignKey(['id_condition'],'conditions',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_conditionUsers'])
                 ->addForeignKey(['id_signature'],'companies',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_signatureUsers'])
                 ->save();
       
    }
}
