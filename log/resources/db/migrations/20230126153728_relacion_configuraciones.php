<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelacionConfiguraciones extends AbstractMigration
{
    
    public function up()
    {
 
        $configuraciones = $this->table('configuraciones');
        $configuraciones    ->addForeignKey(['id_condicion'],'condiciones',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_condicionConfiguracion'])
                    ->save();  
    }
}
