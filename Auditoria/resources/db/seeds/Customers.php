<?php


use Phinx\Seed\AbstractSeed;

class Customers extends AbstractSeed
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
            [
                'name'    => 'foo',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'name'    => 'bar',
                'created' => date('Y-m-d H:i:s'),
            ]
        ];

        $posts = $this->table('customers');
        $posts->insert($data)
              ->saveData();
    }
}
