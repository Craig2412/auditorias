<?php


use Phinx\Seed\AbstractSeed;

class IFormatAppointmentSeeders extends AbstractSeed
{
    
    public function run(): void
    {
        $data = [

                    [
                        'id'    => 1,
                        'format_appointment'    => 'PRESENCIAL'
                    ],[
                        'id'    => 2,
                        'format_appointment'    => 'VIRTUAL'
                    ]
            
                ];

        $posts = $this->table('format_appointments');
        $posts->insert($data)
              ->saveData();
    }
}
