<?php

namespace App\Domain\Permissions\Repository;

use App\Factory\QueryFactory;
use DomainException;

final class PermissionsRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
        $this->fecha = date("d-m-Y H:i:s" , time() - 18000); // Aca esta la fecha del dia (UNIX) menos 5  horas por el huso horario de venezuela.
    }

    public function insertPermissions(array $permissions): int
    {
        return (int)$this->queryFactory->newInsert('permissions', $this->toRow($permissions))
            ->execute()
            ->lastInsertId();
    }

    public function getPermissionsById(int $permissionsId): array
    {
        $query = $this->queryFactory->newSelect('permissions');
        $query->select(
                [
                    'permissions.id',
                    'permissions.name',
                    'permissions.guard_name',
                    'permissions.created',
                    'permissions.updated'
                ]
            );

        $query->where(['permissions.id' => $permissionsId]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('Permissions not found: %s', $permissionsId));
        }

        return $row;
    }

    public function updatePermissions(int $permissionsId, array $permissions): void
    {
        $row = $this->toRow($permissions);

        $this->queryFactory->newUpdate('permissions', $row)
            ->where(['id' => $permissionsId])
            ->execute();
    }

    public function existsPermissionsId(int $permissionsId): bool
    {
        $query = $this->queryFactory->newSelect('permissions');
        $query->select('id')->where(['id' => $permissionsId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    public function deletePermissionsById(int $permissionsId): void
    {
        $this->queryFactory->newDelete('permissions')
            ->where(['id' => $permissionsId])
            ->execute();
    }

    private function toRow(array $permissions): array
    {
        return [
            'name' => $permissions['name'],
            'guard_name' => $permissions['guard_name'],
            'created' => $this->fecha,
            'updated' =>null
        ];
    }
}
