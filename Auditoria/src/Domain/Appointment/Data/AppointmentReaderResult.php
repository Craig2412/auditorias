<?php

namespace App\Domain\Appointment\Data;

final class AppointmentReaderResult
{
    public ?int $id = null;

    public ?string $appointment_date = null;

    public ?int $id_requirement = null;

    public ?string $status = null;
    
    public ?string $format_appointments = null;

    public ?string $created = null;

    public ?string $updated = null;

}