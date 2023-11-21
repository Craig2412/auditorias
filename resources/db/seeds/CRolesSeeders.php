<?php


use Phinx\Seed\AbstractSeed;

class CRolesSeeders extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'id'    => 1,
                'rol'    => 'ADMINISTRADOR'
            ],[
                'id'    => 2,
                'rol'    => 'USUARIO'
            ],[
                'id'    => 3,
                'rol'    => 'TRABAJADOR'
            ]
            ];

        $posts = $this->table('roles');
        $posts->insert($data)
              ->saveData();
    }
}
