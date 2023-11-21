<?php


use Phinx\Seed\AbstractSeed;

class IFormatoCitasSeeders extends AbstractSeed
{
    
    public function run(): void
    {
        $data = [

                    [
                        'id'    => 1,
                        'formato_cita'    => 'PRESENCIAL'
                    ],[
                        'id'    => 2,
                        'formato_cita'    => 'VIRTUAL'
                    ]
            
                ];

        $posts = $this->table('formato_citas');
        $posts->insert($data)
              ->saveData();
    }
}
