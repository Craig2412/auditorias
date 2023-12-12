<?php


use Phinx\Seed\AbstractSeed;

class JEstatusCategorias extends AbstractSeed
{
    
    public function run(): void
    {
        $data = [
            [
                'id'    => 1,
                'estatus_categoria'    => '104',
                'id_categoria'    => '1',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],
            [
                'id'    => 2,
                'estatus_categoria'    => '1',
                'id_categoria'    => '2',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],
            [
                'id'    => 3,
                'estatus_categoria'    => '113',
                'id_categoria'    => '2',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],
            [
                'id'    => 4,
                'estatus_categoria'    => '8',
                'id_categoria'    => '2',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],
            [
                'id'    => 5,
                'estatus_categoria'    => 'TODOS',
                'id_categoria'    => '3',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],
            [
                'id'    => 6,
                'estatus_categoria'    => 'TODOS',
                'id_categoria'    => '4',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],
            [
                'id'    => 7,
                'estatus_categoria'    => 'TODOS',
                'id_categoria'    => '5',
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],
        ];

        $posts = $this->table('estatus_categorias');
        $posts->insert($data)
              ->saveData();
    }
}
