<?php

namespace App\Domain\Usuario\Data;

final class UsuarioFinderItem
{
    public ?int $id = null;
    public ?string $nombre = null;
    public ?string $apellido = null;
    public ?string $correo = null;
    public ?string $identificacion = null;
    public ?string $clave = null;
    public ?string $telefono = null;
    public ?int $id_rol = null;
    public ?int $id_condicion = null;
    public ?string $created = null;
    public ?string $updated = null;
}
