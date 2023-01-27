<?php


use Phinx\Seed\AbstractSeed;

class FEmpresasSeeders extends AbstractSeed
{
    public function run(): void
    {
        $data = [
                    [
                        'id'    => 1,
                        'nombre'    => 'N/A',
                        'rif'    => 'N/A',
                        'bufete'    => 0
                    ]
                ];
    
            $posts = $this->table('empresas');
            $posts->insert($data)
                  ->saveData();
        }
}
