<?php


use Phinx\Seed\AbstractSeed;

class DEstatusSeeders extends AbstractSeed
{
    
    public function run(): void
    {
        $data = [
            [
                'id'    => 1,
                'estatus'  => 'NUEVO',
                'id_agrupacion'  => 1,
                'id_condicion'  => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 2,
                'estatus'  => 'ASIGNADO',
                'id_agrupacion'  => 1,
                'id_condicion'  => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 3,
                'estatus'  => 'PROCESADO',
                'id_agrupacion'  => 1,
                'id_condicion'  => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 4,
                'estatus'  => 'CITA PAUTADA',
                'id_agrupacion'  => 2,
                'id_condicion'  => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 5,
                'estatus'  => 'CITA CANCELADA',
                'id_agrupacion'  => 2,
                'id_condicion'  => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ]
            ];

        $posts = $this->table('estatus');
        $posts->insert($data)
              ->saveData();
    }
}
