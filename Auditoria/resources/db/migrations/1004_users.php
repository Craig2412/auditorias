<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Users extends AbstractMigration{
    
    public function change(): void{
        
        $usuarios = $this->table('users');
        $usuarios->addColumn('name', 'string', ['limit' => 100])
                 ->addColumn('surname', 'string', ['limit' => 100])
                 ->addColumn('email', 'string' , ['limit' => 100])
                 ->addColumn('identification', 'string' , ['limit' => 15])
                 ->addColumn('pass', 'string' , ['limit' => 255])
                 ->addColumn('phone', 'string' , ['limit' => 11])        
                 ->addColumn('id_role', 'integer' , ['null' => false, 'signed' => false, 'default'=> 1])
                 ->addColumn('id_condition', 'integer' , ['null' => false, 'signed' => false, 'default'=> 1])
                 ->addColumn('id_signature', 'integer' , ['null' => false, 'signed' => false, 'default'=> 1])         
                 ->addColumn('created', 'datetime')
                 ->addColumn('updated', 'datetime', ['null' => true])

                 ->addIndex('id_role')
                 ->addIndex('id_condition')
                 ->addIndex('id_signature')
                 ->addIndex('identification', ['unique' => true])
                 
                  ->create();
    }
}
