<?php


use Phinx\Seed\AbstractSeed;

class BDeparmentsSeeders extends AbstractSeed
{
    public function run(): void
    {
        $data = [
                [
                    'id'    => 1,
                    'deparment'    => 'MARCAS',
                    'id_condition'    => 1,
                    'created' => date('Y-m-d H:i:s'),
                    'updated' => null
                ]
            ];
            
        $posts = $this->table('deparments');
        $posts->insert($data)
              ->saveData();
    }
}
