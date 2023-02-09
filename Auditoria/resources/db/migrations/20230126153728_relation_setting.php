<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelationSetting extends AbstractMigration
{
    
    public function up()
    {
 
        $setting = $this->table('settings');
        $setting    ->addForeignKey(['id_condition'],'conditions',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_conditionSetting'])
                    ->save();  
    }
}
