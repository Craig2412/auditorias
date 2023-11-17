<?php


use Phinx\Seed\AbstractSeed;

class BDepartamentosSeeders extends AbstractSeed
{
    public function run(): void
    {
        $data = [
                [
                    'id'    => 1,
                    'departamento'    => 'MARCAS',
                    'id_condicion'    => 1,
                    'created' => date('Y-m-d H:i:s'),
                    'updated' => null
                ]
            ];
            
        $posts = $this->table('departamentos');
        $posts->insert($data)
              ->saveData();
    }
}
