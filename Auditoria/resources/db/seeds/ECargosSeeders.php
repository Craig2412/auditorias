<?php


use Phinx\Seed\AbstractSeed;

class ECargosSeeders extends AbstractSeed
{   
    public function run(): void
    {
        $data = [
            [
                'id'    => 1,
                'cargo'  => 'ANALISTA DE MARCAS'
            ]
            ];

        $posts = $this->table('cargos');
        $posts->insert($data)
              ->saveData();
    }
}
