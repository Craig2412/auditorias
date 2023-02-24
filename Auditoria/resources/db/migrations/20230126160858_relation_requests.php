<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelationRequests extends AbstractMigration
{
    public function up()
    {

        $requests = $this->table('requests');
        $requests   ->addForeignKey(['id_category'],'categories',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_categoryRequest'])
                    ->addForeignKey(['id_requirement'],'requirements',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_requirementRequest'])
                    ->addForeignKey(['id_condition'],'conditions',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_conditionRequest'])
                    ->addForeignKey(['id_status'],'status',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_statusRequest'])
                    ->addForeignKey(['id_company_represented'],'companies',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_company_representedRequest'])
                    ->save();
    }
}
