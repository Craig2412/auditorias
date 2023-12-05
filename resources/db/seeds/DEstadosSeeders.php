<?php


use Phinx\Seed\AbstractSeed;

class DEstadosSeeders extends AbstractSeed
{
    
    public function run(): void
    {
        $data = [
            [
                'id'    => 1,
                'estado'  => 'NUEVO',
                'id_agrupacion'  => 1,
                'id_condicion'  => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 2,
                'estado'  => 'ASIGNADO',
                'id_agrupacion'  => 1,
                'id_condicion'  => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 3,
                'estado'  => 'PROCESADO',
                'id_agrupacion'  => 1,
                'id_condicion'  => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 4,
                'estado'  => 'CITA PAUTADA',
                'id_agrupacion'  => 1,
                'id_condicion'  => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 5,
                'estado'  => 'CITA CANCELADA',
                'id_agrupacion'  => 1,
                'id_condicion'  => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 6,
                'estado'  => 'ABIERTA',
                'id_agrupacion'  => 3,
                'id_condicion'  => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 7,
                'estado'  => 'CERRADA',
                'id_agrupacion'  => 3,
                'id_condicion'  => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ]
            ];

        $posts = $this->table('estados');
        $posts->insert($data)
              ->saveData();
    }
}
