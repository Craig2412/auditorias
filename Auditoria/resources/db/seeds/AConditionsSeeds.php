<?php


use Phinx\Seed\AbstractSeed;

class AConditionsSeeds extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'id'    => 1,
                'condition'    => 'ACTIVO'
            ],[
                'id'    => 2,
                'condition'    => 'INACTIVO'
            ]
            ];

        $posts = $this->table('conditions');
        $posts->insert($data)
              ->saveData();
    }
}
