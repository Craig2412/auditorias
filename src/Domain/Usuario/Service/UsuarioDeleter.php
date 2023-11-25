<?php

namespace App\Domain\Usuario\Service;

use App\Domain\Usuario\Repository\UsuarioRepository;

final class UsuarioDeleter
{
    private UsuarioRepository $repository;

    public function __construct(UsuarioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function deleteUsuario(int $usuarioId): void
    {
        $this->repository->deleteUsuarioById($usuarioId);
    }
}
