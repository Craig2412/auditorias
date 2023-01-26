<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    
    public function run(): void
    {
        $data = [
            [
                'id_user'    => '1',
                'created' => date('Y-m-d H:i:s'),
            ],[
                'id_user'    => '2',
                'created' => date('Y-m-d H:i:s'),
            ]
        ];

        $posts = $this->table('user');
        $posts->insert($data)
              ->saveData();
    }
}
