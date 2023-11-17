<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class PermisosPorRol extends AbstractMigration
{
    public function change(): void
    {
        $permisos_por_rol = $this->table('permisos_por_rol');
        $permisos_por_rol   ->addColumn('id_permisos', 'integer', ['signed' => false])
                 ->addColumn('id_rol', 'integer', ['signed' => false])

                 ->addIndex('id_permisos')
                 ->addIndex('id_rol')
                 ->create();
    }
}