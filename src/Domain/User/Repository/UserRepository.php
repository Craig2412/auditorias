<?php

namespace App\Domain\User\Repository;

use App\Factory\QueryFactory;
use DomainException;
use App\Bcrypt\Bcrypt;

final class UserRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function insertUser(array $user): array    
    {

        $id = $this->queryFactory->newInsert('usuarios', $this->toRow($user))
            ->execute()
            ->lastInsertId();
            return (array)  $this->getUserById($id);
    }

    public function getUserById(int $userId): array
    {
        $query = $this->queryFactory->newSelect('usuarios');
        $query->select(
            [
                'usuarios.id', 
                'r.rol',
                'id_rol'=>'r.id'
            ]
        )->leftJoin(['r' => 'roles'], 'r.id = usuarios.id_rol');
        $query->where(['usuarios.id' => $userId]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('Customer not found: %s', $userId));
        }

        return $row;
        
    }
    public function getUserLogin(string $email, string $pass): array
    {
        $pas = new Bcrypt($pass);
        $query = $this->queryFactory->newSelect('usuarios');
        $query->select(
            [
                'usuarios.id',
                'usuarios.clave',
                'usuarios.id_rol',
                'usuarios.nombre',
                'usuarios.apellido'

            ]
            );

        $query->where(['usuarios.correo' => $email]);
        
        $row = $query->execute()->fetch('assoc');
        $verify = $pas->verifyPass($row['clave']);

        if (!$verify) {
            throw new DomainException(sprintf('User not found: %s', $email));
        }
        return $row;
    }

    public function getPermissionsByUser(int $id_rol): array
    {
        $pas = new Bcrypt($pass);
        $query = $this->queryFactory->newSelect('permisos');
        $query->select(
            [
                'permisos.nombre'
            ]
            )->leftJoin(['p' => 'permisos_por_rol'], 'p.id_permisos = permisos.id');
        $query->where(['p.id_rol' => $id_rol]);
        
        $row = $query->execute()->fetchAll('assoc');

        if (!$row) {
            throw new DomainException(sprintf('Role not found: %s', $email));
        }
        return $row;
    }

    public function updateUser(int $userId, array $customer): void
    {
        $row = $this->toRow($customer);

        $this->queryFactory->newUpdate('usuarios', $row)
            ->where(['id' => $userId])
            ->execute();
    }

    public function existsUserId(int $userId): bool
    {
        $query = $this->queryFactory->newSelect('usuarios');
        $query->select('id')->where(['id' => $userId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    public function deleteUserById(int $userId): void
    {
        $this->queryFactory->newDelete('usuario')
            ->where(['id' => $userId])
            ->execute();
    }

    private function toRow(array $usuarios): array
    {
        $pass = new Bcrypt($usuarios['pass']);
        return [
            'nombre' => $usuarios['nombre'],
            'apellido' => $usuarios['apellido'],
            'telefono' => $usuarios['telefono'],
            'id_rol' => $usuarios['id_rol'],
            'correo' => $usuarios['correo'],
            'id_condicion' => 1,
            'identificacion' => $usuarios['identificacion'],
            'clave' => $pass->createPass(),
            'created' => date('Y-m-d H:i:s')
        ];
    }
}
