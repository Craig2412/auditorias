<?php

namespace App\Domain\Appointment\Repository;

use App\Factory\QueryFactory;
use DomainException;

final class AppointmentsRepositoryUpdate
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

    public function updateAppointment(int $appointmentId, array $appointment): array
    {
        $row = $this->toRow($appointment);
        $this->queryFactory->newUpdate('appointments', $row)
            ->where(['id' => $appointmentId])
            ->execute();
            return $row;
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
            'id_status' => $appointment['id_status'],
            'updated' => $this->fecha
        ];
    }
}
