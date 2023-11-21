<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelationMensajes extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('mensajes');
        $table->addForeignKey(['id_usuario'],'usuarios',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_usuarioMensajes'])
              ->addForeignKey(['id_solicitud'],'solicitudes',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_solicitudMensajes'])
              ->save();
    }
}
