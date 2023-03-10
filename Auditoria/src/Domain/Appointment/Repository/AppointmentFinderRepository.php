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

    public function findAppointment(): array
    {
        $query = $this->queryFactory->newSelect('appointments');

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

        // Add more "use case specific" conditions to the query
        // ...
       // var_dump($query->execute()->fetchAll('assoc') ?: []);

        return $query->execute()->fetchAll('assoc') ?: [];
    }
}
