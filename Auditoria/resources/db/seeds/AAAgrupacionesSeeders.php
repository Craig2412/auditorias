<?php


use Phinx\Seed\AbstractSeed;

class AAAgrupacionesSeeders extends AbstractSeed
{
    public function run(): void
    {
        $data = [
                    [
                        'id'    => 1,
                        'agrupacion'  => 'REQUERIMIENTOS'
                    ],[
                        'id'    => 2,
                        'agrupacion'  => 'CITAS'
                    ],[
                        'id'    => 3,
                        'agrupacion'  => 'SOLICITUDES'
                    ]
                ];

        $posts = $this->table('agrupaciones');
        $posts->insert($data)
              ->saveData();
    }
}
