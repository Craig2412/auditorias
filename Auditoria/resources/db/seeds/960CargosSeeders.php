<?php


use Phinx\Seed\AbstractSeed;

class CargosSeeders extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'id'    => 1,
                'cargo'    => 'ANALISTA DE MARCAS',
            ]
            ];

        $posts = $this->table('roles');
        $posts->insert($data)
              ->saveData();
    }
}
