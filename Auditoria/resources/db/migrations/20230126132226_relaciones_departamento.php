<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelacionesDepartamento extends AbstractMigration
{
    public function up()
    {   
        
        $departamentos = $this->table('departamentos');
        $departamentos->addForeignKey(['id_condicion'],'condiciones',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_condicionDepartments'])
                 ->save();
    }
}
