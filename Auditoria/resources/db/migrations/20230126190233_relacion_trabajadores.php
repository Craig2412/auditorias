<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelacionTrabajadores extends AbstractMigration
{
    public function change(): void
    {

        $trabajadores = $this->table('trabajadores');
        $trabajadores   ->addForeignKey(['id_departamento'],'departamentos',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_departamentoWorker'])
                        ->addForeignKey(['id_cargo'],'cargos',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_cargoWorker'])
                        ->addForeignKey(['id_usuario'],'usuarios',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_usuarioWorker'])
                        ->addForeignKey(['id_categoria'],'categorias',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_categoriaWorker'])
                        ->addForeignKey(['id_estatus'],'estatus',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_estatusWorker'])
                        ->save();
    }
}
