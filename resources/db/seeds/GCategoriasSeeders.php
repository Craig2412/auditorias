<?php


use Phinx\Seed\AbstractSeed;

class GCategoriasSeeders extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'id'    => 1,
                'categoria'    => 'MARCAS DETENIDAS SIN CAUSA JUSTIFICADA (ESTATUS 104).',
                'id_condicion'    => '1',
                'id_departamento'    => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 2,
                'categoria'    => 'MARCAS REZAGADAS  (ESTATUS 1, ESTATUS 113 y ESTATUS 8).',
                'id_condicion'    => '1',
                'id_departamento'    => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 3,
                'categoria'    => 'MODIFICACIONES DE ERRORES A NIVEL DE SISTEMA.',
                'id_condicion'    => '1',
                'id_departamento'    => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 4,
                'categoria'    => 'DESISTIMIENTOS PENDIENTES POR PROCESAR.',
                'id_condicion'    => '1',
                'id_departamento'    => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 5,
                'categoria'    => 'ACTUALIZACIONES DE ESTATUS A NIVEL DE SISTEMA.',
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
