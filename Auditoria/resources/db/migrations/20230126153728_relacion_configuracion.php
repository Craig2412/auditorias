<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelacionConfiguracion extends AbstractMigration
{
    
    public function up()
    {
 
        $configuracion = $this->table('configuracion');
        $configuracion->addForeignKey(['id_condicion'],'condiciones',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_condicionConfig'])
                      ->save();  
    }
}
