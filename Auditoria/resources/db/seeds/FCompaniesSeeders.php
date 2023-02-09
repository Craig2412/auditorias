<?php


use Phinx\Seed\AbstractSeed;

class FCompaniesSeeders extends AbstractSeed
{
    public function run(): void
    {
        $data = [
                    [
                        'id'    => 1,
                        'name'    => 'N/A',
                        'rif'    => 'N/A',
                        'signature'    => 0
                    ]
                ];
    
            $posts = $this->table('companies');
            $posts->insert($data)
                  ->saveData();
        }
}
