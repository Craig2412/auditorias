<?php

namespace App\Domain\Usuario\Repository;

use App\Factory\QueryFactory;
use DomainException;

final class UsuarioRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->fecha = date("Y-m-d H:i:s" , time() - 18000); // Aca esta la fecha del dia (UNIX) menos 5  horas por el uso horario de venezuela
        $this->queryFactory = $queryFactory;

    }

    public function insertUsuario(array $usuario): int
    {
        return (int)$this->queryFactory->newInsert('usuarios', $this->toRow($usuario))
            ->execute()
            ->lastInsertId();
    }

    public function getUsuarioById(int $usuarioId): array
    {
        
        $query = $this->queryFactory->newSelect('usuarios');
        $query->select(
            [
                'usuarios.id',
                'usuarios.nombre',
                'usuarios.apellido',
                'usuarios.correo',
                'usuarios.identificacion',
                'usuarios.clave',
                'usuarios.telefono',
                'usuarios.id_rol',
                'roles.rol',
                'usuarios.created',
                'usuarios.updated'
            ]
        )
        ->leftjoin(['roles'=>'roles'], 'roles.id = usuarios.id_rol');

        $query->where(['usuarios.id_condicion' => 1,'usuarios.id' => $usuarioId]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('Usuario not found: %s', $usuarioId));
        }
        return $row;
    }

    public function updateUsuario(int $usuarioId, array $usuario): array
    {
        $row = $this->toRowUpdate($usuario);
        $row["updated"] = $this->fecha; 
        $this->queryFactory->newUpdate('usuarios', $row)
            ->where(['id' => $usuarioId])
            ->execute();
            return $row;
    }

    public function existsUsuarioId(int $usuarioId): bool
    {
        $query = $this->queryFactory->newSelect('usuarios');
        $query->select('id')->where(['id' => $usuarioId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    public function deleteUsuarioById(int $usuarioId): void
    {
        $this->queryFactory->newDelete('usuarios')
            ->where(['id' => $usuarioId])
            ->execute();
    }

    private function toRow(array $usuario): array
    { 
        return [
            'nombre' => strtoupper($usuario['nombre']),
            'apellido' => strtoupper($usuario['apellido']),
            'correo' => strtoupper($usuario['correo']),
            'identificacion' => strtoupper($usuario['identificacion']),
            'clave' => strtoupper($usuario['clave']),
            'telefono' => $usuario['telefono'],
            'id_rol' => $usuario['id_rol'],
            'id_condicion' => 1,
            'created' => $this->fecha,
            'updated' => null
        ];
    }

    private function toRowUpdate(array $usuario): array
    {        
        return [
            'nombre' => strtoupper($usuario['nombre']),
            'apellido' => strtoupper($usuario['apellido']),
            'correo' => strtoupper($usuario['correo']),
            'identificacion' => strtoupper($usuario['identificacion']),
            'clave' => strtoupper($usuario['clave']),
            'telefono' => $usuario['telefono'],
            'id_rol' => $usuario['id_rol'],
            'id_condicion' => $usuario['id_condicion'],
            'updated' => $this->fecha
        ];
    }
}