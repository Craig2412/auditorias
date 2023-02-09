<?php


use Phinx\Seed\AbstractSeed;

class EChargesSeeders extends AbstractSeed
{   
    public function run(): void
    {
        $data = [
            [
                'id'    => 1,
                'charge'  => 'ANALISTA DE MARCAS'
            ]
            ];

        $posts = $this->table('charges');
        $posts->insert($data)
              ->saveData();
    }
}
