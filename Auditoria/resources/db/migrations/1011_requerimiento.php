<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Requerimiento extends AbstractMigration
{
    public function change(): void
    {
        $requerimientos = $this->table('requerimientos');
        $requerimientos ->addColumn('cant_solicitudes', 'integer')
                        ->addColumn('id_usuario', 'integer', ['signed' => false])
                        ->addColumn('id_condicion', 'integer', ['signed' => false])
                        ->addColumn('id_estatus', 'integer', ['signed' => false])
                        ->addColumn('id_trabajador', 'integer', ['signed' => false])
                        ->addColumn('id_empresa_representada', 'integer', ['signed' => false])
                        ->addColumn('created', 'datetime')
                        ->addColumn('updated', 'datetime', ['null' => true])

                        ->addIndex('id_usuario')
                        ->addIndex('id_condicion')
                        ->addIndex('id_estatus')
                        ->addIndex('id_trabajador')
                        ->addIndex('id_empresa_representada')
                        
                        ->addForeignKey(['id_usuario'],'usuarios',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_usuarioRequire'])
                        ->addForeignKey(['id_condicion'],'condiciones',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_condicionRequire'])
                        ->addForeignKey(['id_trabajador'],'trabajadores',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_trabajadorRequire'])
                        ->addForeignKey(['id_estatus'],'estatus',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_estatusRequire'])
                        ->addForeignKey(['id_empresa_representada'],'empresas',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_empresa_representadaRequire'])
                        ->create();
    }
}
