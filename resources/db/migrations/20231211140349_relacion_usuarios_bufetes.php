<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelacionUsuariosBufetes extends AbstractMigration
{
    public function change(): void
    {

        $usuarios_bufetes = $this->table('usuarios_bufetes');
        $usuarios_bufetes ->addForeignKey(['id_usuario'],'usuarios',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_usuarioUserBufete'])
                        ->addForeignKey(['id_bufete'],'bufetes',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_bufeteUserBufete'])
                        ->save();
    }
}
