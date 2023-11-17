<?php


use Phinx\Seed\AbstractSeed;

class HUsuariosSeeders extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'id'    => 1,
                'nombre'    => 'Alex',
                'apellido'    => 'Aular',
                'correo'    => 'aularalexander55@gmail.com',
                'identificacion'    => 'V027038431',
                'clave'    => 'V027038432',
                'telefono'    => 4127008592,
                'id_rol'    => 1,
                'id_condicion' => 1,
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 2,
                'nombre'    => 'Ely',
                'apellido'    => 'Chirivella',
                'correo'    => 'elychirivella10@gmail.com',
                'identificacion'    => 'V027038432',
                'clave'    => 'V027038432',
                'telefono'    => 4127008593,
                'id_rol'    => 1,
                'id_condicion'    => 1,
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 3,
                'nombre'    => 'Admin',
                'apellido'    => 'Registro',
                'correo'    => 'direccion.registro@gmail.com',
                'identificacion'    => 'G200083999',
                'clave'    => 'G200083999',
                'telefono'    => 2120000000,
                'id_rol'    => 1,
                'id_condicion'    => 1,
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ]
        ];

        $posts = $this->table('usuarios');
        $posts->insert($data)
              ->saveData();
    }
}
