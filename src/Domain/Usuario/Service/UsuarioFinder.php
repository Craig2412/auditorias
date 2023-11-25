<?php

namespace App\Domain\Usuario\Service;

use App\Domain\Usuario\Data\UsuarioFinderItem;
use App\Domain\Usuario\Data\UsuarioFinderResult;
use App\Domain\Usuario\Repository\UsuarioFinderRepository;

final class UsuarioFinder
{
    private UsuarioFinderRepository $repository;

    public function __construct(UsuarioFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findUsuario($nro_pag,$where,$cant_registros): UsuarioFinderResult
    {
        // Input validation
        $usuario = $this->repository->findUsuario($nro_pag,$where,$cant_registros);

        return $this->createResult($usuario);
    }

    private function createResult(array $usuarioRows): UsuarioFinderResult
    {
        $result = new UsuarioFinderResult();

        foreach ($usuarioRows as $usuarioRow) {
            $usuario = new UsuarioFinderItem();
           
            $usuario->id = $usuarioRow['id'];
            $usuario->nombre = $usuarioRow['nombre'];
            $usuario->apellido = $usuarioRow['apellido'];
            $usuario->correo = $usuarioRow['correo'];
            $usuario->identificacion = $usuarioRow['identificacion'];
            $usuario->clave = $usuarioRow['clave'];
            $usuario->telefono = $usuarioRow['telefono'];
            $usuario->id_rol = $usuarioRow['id_rol'];
            $usuario->rol = $usuarioRow['rol'];
            $usuario->id_condicion = $usuarioRow['id_condicion'];
            $usuario->created = $usuarioRow['created'];
            $usuario->updated = $usuarioRow['updated'];

            $result->usuario[] = $usuario;
        }

        return $result;
    }
}
