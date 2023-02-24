<?php


use Phinx\Seed\AbstractSeed;

class HUsersSeeders extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'id'    => 1,
                'name'    => 'Alex',
                'surname'    => 'Aular',
                'email'    => 'aularalexander55@gmail.com',
                'identification'    => 'V027038431',
                'pass'    => 'V027038432',
                'phone'    => 4127008592,
                'id_role'    => 1,
                'id_condition' => 1,
                'id_signature'    =>1,
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ],[
                'id'    => 2,
                'name'    => 'Ely',
                'surname'    => 'Chirivella',
                'email'    => 'elychirivella10@gmail.com',
                'identification'    => 'V027038432',
                'pass'    => 'V027038432',
                'phone'    => 4127008592,
                'id_role'    => 1,
                'id_condition'    => 1,
                'id_signature'    => 1,
                'created' => date('Y-m-d H:i:s'),
                'updated' => null
            ]
        ];

        $posts = $this->table('users');
        $posts->insert($data)
              ->saveData();
    }
}
