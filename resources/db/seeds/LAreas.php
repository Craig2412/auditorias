<?php


use Phinx\Seed\AbstractSeed;

class LAreas extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'id'    => 1,
                'area'    => 'AREA 1'
            ],[
                'id'    => 2,
                'area'    => 'AREA 2'
            ],[
                'id'    => 3,
                'area'    => 'AREA 3'
            ]
            ];

        $posts = $this->table('areas');
        $posts->insert($data)
              ->saveData();
    }
}
 