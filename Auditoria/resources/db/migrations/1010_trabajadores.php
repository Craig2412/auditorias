<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Trabajadores extends AbstractMigration
{
    public function change(): void
    {
        $trabajadores = $this->table('trabajadores');
        $trabajadores   ->addColumn('cant_requerimientos', 'integer')
                        ->addColumn('id_cargo', 'integer', ['signed' => false])
                        ->addColumn('id_usuario', 'integer', ['signed' => false])
                        ->addColumn('id_categoria', 'integer', ['signed' => false])
                        ->addColumn('id_estatus', 'integer', ['signed' => false])                        
                        ->addColumn('id_departamento', 'integer', ['signed' => false])                        
                        ->addColumn('created', 'datetime')
                        ->addColumn('updated', 'datetime', ['null' => true])

                        ->addIndex('id_cargo')
                        ->addIndex('id_usuario')
                        ->addIndex('id_categoria')
                        ->addIndex('id_estatus')
                        ->addIndex('id_departamento')
                        ->create();
    }
}
