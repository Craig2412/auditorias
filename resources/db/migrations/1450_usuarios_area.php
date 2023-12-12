<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UsuariosArea extends AbstractMigration
{
    public function change(): void
    {
        $usuarios_area = $this->table('usuarios_area');
        $usuarios_area  ->addColumn('id_usuario', 'integer' , ['null' => false , 'signed' => false])
                        ->addColumn('id_area', 'integer', ['null' => false ,'signed' => false])

                        ->addIndex('id_area')
                        ->addIndex('id_usuario', ['unique' => true])
                        

                        ->create();
    }
}
