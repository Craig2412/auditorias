<?php

namespace App\Domain\Appointment\Repository;

use App\Factory\QueryFactory;
use DomainException;

final class AppointmentRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
        $this->fecha = date("d-m-Y H:i:s" , time() - 18000); // Aca esta la fecha del dia (UNIX) menos 5  horas por el uso horario de venezuela
    }

    public function insertAppointment(array $appointment): int
    {
        return (int)$this->queryFactory->newInsert('appointments', $this->toRow($appointment))
            ->execute()
            ->lastInsertId();
    }

    public function getAppointmentById(int $appointmentId): array
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

        $query->where(['appointments.id' => $appointmentId]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('Appointment not found: %s', $appointmentId));
        }

        return $row;
    }

    public function updateAppointment(int $appointmentId, array $appointment): void
    {
        $row = $this->toRow($appointment);

        $this->queryFactory->newUpdate('appointments', $row)
            ->where(['id' => $appointmentId])
            ->execute();
    }

    public function existsAppointmentId(int $appointmentId): bool
    {
        $query = $this->queryFactory->newSelect('appointments');
        $query->select('id')->where(['id' => $appointmentId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    public function deleteAppointmentById(int $appointmentId): void
    {
        $this->queryFactory->newDelete('appointments')
            ->where(['id' => $appointmentId])
            ->execute();
    }

    private function toRow(array $appointment): array
    {
        return [
            'appointment_date' => $appointment['appointment_date'],
            'id_requirement' => $appointment['id_requirement'],
            'id_status' => $appointment['id_status'],
            'id_format_appointments' => $appointment['id_format_appointments'],
            'created' => $this->fecha,
            'updated' =>null
        ];
    }
}
