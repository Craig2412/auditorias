<?php


use Phinx\Seed\AbstractSeed;

class IPermissions extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $data = [

            //appointments
            [
                "name" => 'appointments.create',
                "guard_name" => 'web'
            ],
            [
                "name" => 'appointments.read',
                "guard_name" => 'web'
            ],
            [
                "name" => 'appointments.update',
                "guard_name" => 'web'
            ],
            [
                "name" => 'appointments.delete',
                "guard_name" => 'web'
            ],

            //requirements
            [
                "name" => 'requirements.create',
                "guard_name" => 'web'
            ],
            [
                "name" => 'requirements.read',
                "guard_name" => 'web'
            ],
            [
                "name" => 'requirements.update',
                "guard_name" => 'web'
            ],
            [
                "name" => 'requirements.delete',
                "guard_name" => 'web'
            ],
            [
                "name" => 'requirements.complete',
                "guard_name" => 'web'
            ],

            //requests
            [
                "name" => 'requests.create',
                "guard_name" => 'web'
            ],
            [
                "name" => 'requests.read',
                "guard_name" => 'web'
            ],
            [
                "name" => 'requests.update',
                "guard_name" => 'web'
            ],
            [
                "name" => 'requests.delete',
                "guard_name" => 'web'
            ],
            [
                "name" => 'requests.complete',
                "guard_name" => 'web'
            ],


            //workers
            [
                "name" => 'workers.create',
                "guard_name" => 'web'
            ],
            [
                "name" => 'workers.read',
                "guard_name" => 'web'
            ],
            [
                "name" => 'workers.update',
                "guard_name" => 'web'
            ],
            [
                "name" => 'workers.delete',
                "guard_name" => 'web'
            ],

            //workers
            [
                "name" => 'users.create',
                "guard_name" => 'web'
            ],
            [
                "name" => 'users.read',
                "guard_name" => 'web'
            ],
            [
                "name" => 'users.update',
                "guard_name" => 'web'
            ],
            [
                "name" => 'users.delete',
                "guard_name" => 'web'
            ],

            //settings
            [
                "name" => 'settings.create',
                "guard_name" => 'web'
            ],
            [
                "name" => 'settings.read',
                "guard_name" => 'web'
            ],
            [
                "name" => 'settings.update',
                "guard_name" => 'web'
            ],
            [
                "name" => 'settings.delete',
                "guard_name" => 'web'
            ],

        ];

        $posts = $this->table('permissions');
        $posts->insert($data)
        ->saveData();

    }
}
