<?php


use Phinx\Seed\AbstractSeed;

class DStatusSeeders extends AbstractSeed
{
    
    public function run(): void
    {
        $data = [
            [
                'id'    => 1,
                'status'  => 'NUEVO',
                'id_grouping'  => 1,
                'id_condition'  => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 2,
                'status'  => 'ASIGNADO',
                'id_grouping'  => 1,
                'id_condition'  => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 3,
                'status'  => 'PROCESADO',
                'id_grouping'  => 1,
                'id_condition'  => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 4,
                'status'  => 'CITA PAUTADA',
                'id_grouping'  => 2,
                'id_condition'  => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 5,
                'status'  => 'CITA CANCELADA',
                'id_grouping'  => 2,
                'id_condition'  => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 6,
                'status'  => 'ABIERTA',
                'id_grouping'  => 3,
                'id_condition'  => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 7,
                'status'  => 'CERRADA',
                'id_grouping'  => 3,
                'id_condition'  => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ]
            ];

        $posts = $this->table('status');
        $posts->insert($data)
              ->saveData();
    }
}
