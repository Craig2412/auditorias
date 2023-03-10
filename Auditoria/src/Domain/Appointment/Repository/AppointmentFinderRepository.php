<?php

namespace App\Domain\Appointment\Repository;

use App\Factory\QueryFactory;

final class AppointmentFinderRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function findAppointment($nro_pag,$where,$cant_registros): array
    {
        //Paginador
            $limit = $cant_registros;
            $offset = ($nro_pag - 1) * $limit;
            $query = $this->queryFactory->newSelect('appointments');
        //Fin Paginador

        $query->select(
            [
                'appointments.id',
                'appointments.appointment_date',
                'appointments.id_requirement',
                'state.status',
                'format_appointment.format_appointment',
                'appointments.created',
                'appointments.updated'
            ]
        )
        ->leftjoin(['state'=>'status'], 'state.id = appointments.id_status')
        ->leftjoin(['format_appointment'=>'format_appointments'], 'format_appointment.id = appointments.id_format_appointments'); 
        
        //Paginador
            if (!empty($where)) {
                $query->where($where);    
            }            
            $query->offset([$offset]);
            $query->limit([$limit]);
        //Fin paginador


        return $query->execute()->fetchAll('assoc') ?: [];
    }
}
