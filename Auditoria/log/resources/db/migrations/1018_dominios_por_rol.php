<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class DominiosPorRol extends AbstractMigration
{
  
    public function change(): void
    {
        $dominio_por_rol = $this->table('dominio_por_rol');
        $dominio_por_rol   ->addColumn('dominio', 'string',['limit' => 500])
                 ->addColumn('id_rol', 'integer', ['signed' => false])

                 ->addIndex('id_rol')
                 ->create();
    }
}
