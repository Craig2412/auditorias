<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelacionRequerimientos extends AbstractMigration
{
    public function up()
    {

        $requerimientos = $this->table('requerimientos');
        $requerimientos ->addForeignKey(['id_usuario'],'usuarios',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_usuarioRequire'])
                        ->addForeignKey(['id_condicion'],'condiciones',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_condicionRequire'])
                        ->addForeignKey(['id_trabajador'],'trabajadores',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_trabajadorRequire'])
                        ->addForeignKey(['id_estatus'],'estatus',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_estatusRequire'])
                        ->addForeignKey(['id_empresa_representada'],'empresas',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_empresa_representadaRequire'])
                        ->save();
    }
}
