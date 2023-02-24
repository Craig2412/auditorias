<?php


use Phinx\Seed\AbstractSeed;

class AAGroupingsSeeders extends AbstractSeed
{
    public function run(): void
    {
        $data = [
                    [
                        'id'    => 1,
                        'grouping'  => 'REQUERIMIENTOS'
                    ],[
                        'id'    => 2,
                        'grouping'  => 'CITAS'
                    ],[
                        'id'    => 3,
                        'grouping'  => 'SOLICITUDES'
                    ]
                ];

        $posts = $this->table('groupings');
        $posts->insert($data)
              ->saveData();
    }
}
