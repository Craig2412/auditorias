<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CronologiaSolicitudes extends AbstractMigration
{
    public function change(): void{
        
        $cronologia_solicitudes = $this->table('cronologia_solicitudes');
        $cronologia_solicitudes->addColumn('crono', 'string', ['limit' => 300])
                 ->addColumn('id_usuario', 'integer' , ['null' => false , 'signed' => false])
                 ->addColumn('id_solicitud', 'integer' , ['null' => false , 'signed' => false])
                 ->addColumn('id_condicion', 'integer' , ['null' => false , 'signed' => false])
                 ->addColumn('created', 'datetime')
                 ->addColumn('updated', 'datetime', ['null' => true])

                 ->addIndex('id_usuario')
                 ->addIndex('id_solicitud')
                 ->addIndex('id_condicion')
                 
                 ->create();
    }
}
