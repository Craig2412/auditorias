<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Usuarios extends AbstractMigration{
    
    public function change(): void{
        $usuarios = $this->table('usuarios');
        $usuarios->addColumn('nombre', 'string', ['limit' => 100])
                 ->addColumn('apellido', 'string', ['limit' => 100])
                 ->addColumn('email', 'string' , ['limit' => 100])
                 ->addColumn('telefono', 'integer' , ['limit' => 11])        
                 ->addColumn('id_rol', 'integer' , ['null' => false, 'signed' => false])
                 ->addColumn('id_condicion', 'integer' , ['null' => false, 'signed' => false])
                 ->addColumn('id_bufete', 'integer' , ['null' => false, 'signed' => false])         
                 ->addColumn('created', 'datetime')
                 ->addColumn('updated', 'datetime', ['null' => true])

                 ->addIndex('id_rol')
                 ->addIndex('id_condicion')
                 ->addIndex('id_bufete')
                 
                 ->addForeignKey(['id_rol'],'roles',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_rolUsers'])
                 ->addForeignKey(['id_condicion'],'condiciones',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_condicionUsers'])
                 ->addForeignKey(['id_bufete'],'empresas',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_bufeteUsers'])
                 ->create();
    }
}
