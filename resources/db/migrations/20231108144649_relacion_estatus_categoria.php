<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelacionEstatusCategoria extends AbstractMigration
{
    public function change(): void
    {

        $estatus_categorias = $this->table('estatus_categorias');
        $estatus_categorias ->addForeignKey(['id_categoria'],'categorias',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_categoriaEstatusCategoria'])
                           ->save();
    }
}
