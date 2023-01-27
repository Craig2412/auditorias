<?php


use Phinx\Seed\AbstractSeed;

class ACondicionesSeeds extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'id'    => 1,
                'condicion'    => 'ACTIVO'
            ],[
                'id'    => 2,
                'condicion'    => 'INACTIVO'
            ]
            ];

        $posts = $this->table('condiciones');
        $posts->insert($data)
              ->saveData();
    }
}
