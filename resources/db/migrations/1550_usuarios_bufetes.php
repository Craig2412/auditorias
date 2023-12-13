<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UsuariosBufetes extends AbstractMigration
{
    
    public function change(): void
    {
        $usuarios_bufetes = $this->table('usuarios_bufetes');
        $usuarios_bufetes   ->addColumn('id_usuario', 'integer' , ['null' => false , 'signed' => false])
                            ->addColumn('id_bufete', 'integer', ['null' => false ,'signed' => false])

                            ->addIndex('id_usuario', ['unique' => true])
                            ->addIndex('id_bufete')
                            

                            ->create();
    }
}
