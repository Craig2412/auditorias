<?php

namespace App\Domain\Appointment\Service;

use App\Domain\Appointment\Data\AppointmentFinderItem;
use App\Domain\Appointment\Data\AppointmentFinderResult;
use App\Domain\Appointment\Repository\AppointmentFinderRepository;

final class AppointmentFinder
{
    private AppointmentFinderRepository $repository;

    public function __construct(AppointmentFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findAppointment($nro_pag,$parametros,$cant_registros): AppointmentFinderResult
    {

        $appointment = $this->repository->findAppointment($nro_pag,$parametros,$cant_registros);

        return $this->createResult($appointment);
    }

    private function createResult(array $appointmentsRows): AppointmentFinderResult
    {
        $result = new AppointmentFinderResult();

        foreach ($appointmentsRows as $appointmentsRow) {
            $appointments = new AppointmentFinderItem();
            $appointments->id = $appointmentsRow['id'];
            $appointments->appointment_date = $appointmentsRow['appointment_date'];
            $appointments->id_requirement = $appointmentsRow['id_requirement'];
            $appointments->status = $appointmentsRow['status'];
            $appointments->format_appointment = $appointmentsRow['format_appointment'];
            $appointments->created = $appointmentsRow['created'];
            $appointments->updated = $appointmentsRow['updated'];

            $result->appointment[] = $appointments;
        }
        return $result;
    }
}
