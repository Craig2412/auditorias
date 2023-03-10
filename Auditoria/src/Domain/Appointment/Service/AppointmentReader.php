<?php

namespace App\Domain\Appointment\Service;

use App\Domain\Appointment\Data\AppointmentReaderResult;
use App\Domain\Appointment\Repository\AppointmentRepository;

/**
 * Service.
 */
final class AppointmentReader
{
    private AppointmentRepository $repository;

    /**
     * The constructor.
     *
     * @param AppointmentRepository $repository The repository
     */
    public function __construct(AppointmentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a appointments.
     *
     * @param int $appointmentsId The appointments id
     *
     * @return AppointmentReaderResult The result
     */
    public function getAppointment(int $appointmentsId): AppointmentReaderResult
    {
        // Input validation
        // ...

        // Fetch data from the database
        $appointmentsRow = $this->repository->getAppointmentById($appointmentsId);

        // Optional: Add or invoke your complex business logic here
        // ...
        // Create domain result
        $result = new AppointmentReaderResult();
        $result->id = $appointmentsRow['id'];
        $result->appointment_date = $appointmentsRow['appointment_date'];
        $result->id_requirement = $appointmentsRow['id_requirement'];
        $result->status = $appointmentsRow['status'];
        $result->format_appointments = $appointmentsRow['format_appointment'];
        $result->created = $appointmentsRow['created'];
        $result->updated = $appointmentsRow['updated'];

        return $result;
    }
}
