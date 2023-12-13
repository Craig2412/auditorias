<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelacionUsuariosArea extends AbstractMigration
{
    public function change(): void
    {

        $usuarios_areas = $this->table('usuarios_area');
        $usuarios_areas ->addForeignKey(['id_usuario'],'usuarios',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_usuarioUserArea'])
                 ->addForeignKey(['id_area'],'areas',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_areaUserArea'])
                ->save();
    }
}
