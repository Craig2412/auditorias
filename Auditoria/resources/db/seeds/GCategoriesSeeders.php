<?php


use Phinx\Seed\AbstractSeed;

class GCategoriesSeeders extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'id'    => 1,
                'category'    => 'Marcas detenidas sin causa justificada (estatus 104).',
                'id_condition'    => '1',
                'id_deparment'    => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 2,
                'category'    => 'Marcas rezagadas (estatus 1, estatus 113 y estatus 8).',
                'id_condition'    => '1',
                'id_deparment'    => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 3,
                'category'    => 'Modificaciones de errores a nivel de sistema.',
                'id_condition'    => '1',
                'id_deparment'    => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 4,
                'category'    => 'Desistimientos pendientes por procesar.',
                'id_condition'    => '1',
                'id_deparment'    => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 5,
                'category'    => 'Actualizaciones de estatus a nivel de sistema.',
                'id_condition'    => '1',
                'id_deparment'    => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ]
        ];

        $posts = $this->table('categories');
        $posts->insert($data)
              ->saveData();
    }
}
