<?php


use Phinx\Seed\AbstractSeed;

class GCategoriasSeeders extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'id'    => 1,
                'categoria'    => 'Marcas detenidas sin causa justificada (estatus 104).',
                'id_condicion'    => '1',
                'id_departamento'    => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 2,
                'categoria'    => 'Marcas rezagadas (estatus 1, estatus 113 y estatus 8).',
                'id_condicion'    => '1',
                'id_departamento'    => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 3,
                'categoria'    => 'Modificaciones de errores a nivel de sistema.',
                'id_condicion'    => '1',
                'id_departamento'    => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 4,
                'categoria'    => 'Desistimientos pendientes por procesar.',
                'id_condicion'    => '1',
                'id_departamento'    => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 5,
                'categoria'    => 'Actualizaciones de estatus a nivel de sistema.',
                'id_condicion'    => '1',
                'id_departamento'    => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ]
        ];

        $posts = $this->table('categorias');
        $posts->insert($data)
              ->saveData();
    }
}
