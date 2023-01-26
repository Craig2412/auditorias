<?php


use Phinx\Seed\AbstractSeed;

class CondicionSeeders extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'id'    => 1,
                'condicion'    => 'ACTIVO',
            ],[
                'id'    => 2,
                'condicion'    => 'INACTIVO',
            ]
            ];

        $posts = $this->table('condicion');
        $posts->insert($data)
              ->saveData();
    }
}
