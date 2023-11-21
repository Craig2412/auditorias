<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelacionDominioPorRol extends AbstractMigration
{
   
    public function change(): void
    {
        $dominio_por_rol = $this->table('dominio_por_rol');
        $dominio_por_rol   ->addForeignKey(['id_rol'],'roles',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_rolPermiDom'])
                        ->save();
    }
}
