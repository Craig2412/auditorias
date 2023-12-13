<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RelacionEstadosPaises extends AbstractMigration
{
    
    public function change(): void
    {
        $estados_paises = $this->table('estados_paises');
        $estados_paises ->addForeignKey(['id_pais'],'paises',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_paisEstadosPaises'])
                 ->addForeignKey(['id_condicion'],'condiciones',['id'],['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION', 'constraint' => 'id_condicionEstadosPaises'])
                ->save();
    }
}
