<?php

namespace App\Domain\Requirements\Data;

final class RequirementsReaderResult
{
    public ?int $id = null;

    public ?int $amount_request = null;

    public ?int $id_format_appointment = null;

    public ?int $id_user = null;

    public ?int $id_condition = null;

    public ?int $id_status = null;

    public ?int $id_worker   = null;

    public ?string $created = null;

    public ?string $updated = null;

}