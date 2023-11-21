<?php


use Phinx\Seed\AbstractSeed;

class IPermisos extends AbstractSeed
{
    
    
    public function run(): void
    {
        $data = [

            //citas
            [
                "nombre" => 'citas.create',
                "guard_name" => 'web'
            ],
            [
                "nombre" => 'citas.read',
                "guard_name" => 'web'
            ],
            [
                "nombre" => 'citas.update',
                "guard_name" => 'web'
            ],
            [
                "nombre" => 'citas.delete',
                "guard_name" => 'web'
            ],

            //requerimientos
            [
                "nombre" => 'requerimientos.create',
                "guard_name" => 'web'
            ],
            [
                "nombre" => 'requerimientos.read',
                "guard_name" => 'web'
            ],
            [
                "nombre" => 'requerimientos.update',
                "guard_name" => 'web'
            ],
            [
                "nombre" => 'requerimientos.delete',
                "guard_name" => 'web'
            ],
            [
                "nombre" => 'requerimientos.complete',
                "guard_name" => 'web'
            ],

            //solicitudes
            [
                "nombre" => 'solicitudes.create',
                "guard_name" => 'web'
            ],
            [
                "nombre" => 'solicitudes.read',
                "guard_name" => 'web'
            ],
            [
                "nombre" => 'solicitudes.update',
                "guard_name" => 'web'
            ],
            [
                "nombre" => 'solicitudes.delete',
                "guard_name" => 'web'
            ],
            [
                "nombre" => 'solicitudes.complete',
                "guard_name" => 'web'
            ],



            //usuarios
            [
                "nombre" => 'usuarios.create',
                "guard_name" => 'web'
            ],
            [
                "nombre" => 'usuarios.read',
                "guard_name" => 'web'
            ],
            [
                "nombre" => 'usuarios.update',
                "guard_name" => 'web'
            ],
            [
                "nombre" => 'usuarios.delete',
                "guard_name" => 'web'
            ],

            //configuraciones
            [
                "nombre" => 'configuraciones.create',
                "guard_name" => 'web'
            ],
            [
                "nombre" => 'configuraciones.read',
                "guard_name" => 'web'
            ],
            [
                "nombre" => 'configuraciones.update',
                "guard_name" => 'web'
            ],
            [
                "nombre" => 'configuraciones.delete',
                "guard_name" => 'web'
            ],

        ];

        $posts = $this->table('permisos');
        $posts->insert($data)
        ->saveData();

    }
}
