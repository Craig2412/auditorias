<?php

namespace App\Domain\User\Data;


final class UserLoginResult
{
    public ?int $id = null;

    public ?string $token = null;

    public ?string $name = null;

    public ?int $id_rol = null;
}
