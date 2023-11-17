<?php

namespace App\Domain\Permissions\Repository;

use App\Factory\QueryFactory;
use DomainException;
use App\Bcrypt\Bcrypt;

final class PermissionsRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function getPermissionById(int $permissionsId): array
    {
        $query = $this->queryFactory->newSelect('permissions');
        $query->select(
            [
                'permissions.name', 
                'permissions.guard_name'
            ]
        );
        $query->where(['permissions.id' => $permissionsId]);
        $row = $query->execute()->fetch('assoc');
        if (!$row) {
            throw new DomainException(sprintf('Permissions not found: %s', $permissionsId));
        }
        return $row;
    }

    public function getPermissionByRole(int $permissionsId): array
    {
        $query = $this->queryFactory->newSelect('permissions');
        $query->select(
            [
                'permissions.name', 
                'permissions.guard_name'
            ]
        );
        $query->where(['permissions.id' => $permissionsId]);
        $row = $query->execute()->fetch('assoc');
        if (!$row) {
            throw new DomainException(sprintf('Permissions not found: %s', $permissionsId));
        }
        return $row;
    }

    public function getUserLogin(string $email, string $pass): array
    {
        $pas = new Bcrypt($pass);
        $query = $this->queryFactory->newSelect('users');
        $query->select(
                [
                    'users.id',
                    'users.pass'
                ]
            );
        $query->where(['users.email' => $email]);
        
        $row = $query->execute()->fetch('assoc');
        $verify = $pas->verifyPass($row['pass']);

        if (!$verify) {
            throw new DomainException(sprintf('User not found: %s', $email));
        }
        return $row;
    }

    public function updateUser(int $userId, array $customer): void
    {
        $row = $this->toRow($customer);

        $this->queryFactory->newUpdate('users', $row)
            ->where(['id' => $userId])
            ->execute();
    }

    public function existsUserId(int $userId): bool
    {
        $query = $this->queryFactory->newSelect('users');
        $query->select('id')->where(['id' => $userId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    public function deleteUserById(int $userId): void
    {
        $this->queryFactory->newDelete('users')
            ->where(['id' => $userId])
            ->execute();
    }

    private function toRow(array $usuario): array
    {
        $pass = new Bcrypt($usuario['pass']);
        return [
            'name' => $usuario['name'],
            'surname' => $usuario['surname'],
            'phone' => $usuario['phone'],
            'id_role' => $usuario['id_role'],
            'email' => $usuario['email'],
            'id_condition' => $usuario['id_condition'],
            'id_signature' => $usuario['id_signature'],
            'identification' => $usuario['identification'],
            'pass' => $pass->createPass(),
            'created' => date('Y-m-d H:i:s')
        ];
    }
}
