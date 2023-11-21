<?php

namespace App\Domain\Bufete\Data;

/**
 * DTO.
 */
final class BufeteReaderResult
{
    public ?int $id = null;

    public ?string $nombre_bufete = null;

    public ?string $rif = null;

    public ?string $telefono = null;
    
    public ?string $correo = null;

    public ?string $nombre = null;

    public ?string $apellido = null;

    public ?string $identificacion = null;

    public ?int $id_usuario = null;
    
    public ?int $id_condicion = null;

    public ?string $created = null;

    public ?string $updated = null;
}