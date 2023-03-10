<?php

namespace App\Domain\Companies\Data;

/**
 * DTO.
 */
final class CompaniesReaderResult
{
    public ?int $id = null;

    public ?string $name = null;

    public ?string $rif = null;

    public ?string $signature = null;
}