<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelacionCategorias extends AbstractMigration
{
    public function up()
    {

        $categorias = $this->table('categorias');
        $categorias->addForeignKey(['id_departamento'],'departamentos',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_departamentoCategorias'])
                   ->addForeignKey(['id_condicion'],'condiciones',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_condicionCategorias'])
                   ->save();
    }
}
