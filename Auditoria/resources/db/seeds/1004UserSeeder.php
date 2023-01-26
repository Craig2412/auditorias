<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    
    public function run(): void
    {
        $data = [
            [
                'id_user'    => 1,
                'nombre'    => 'Alex',
                'apellido'    => 'Aular',
                'email'    => 'aularalexander55@gmail.com',
                'telefono'    => 4127008592,
                'id_rol'    => 1,
                'id_condicion' => 1,
                'id_bufete'    =>1,
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id_user'    => 2,
                'nombre'    => 'Ely',
                'apellido'    => 'Chirivella',
                'email'    => 'elychirivella10@gmail.com',
                'telefono'    => 4127008592,
                'id_rol'    => 1,
                'id_condicion'    => 1,
                'id_bufete'    => 1,
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ]
        ];

        $posts = $this->table('user');
        $posts->insert($data)
              ->saveData();
    }
}
