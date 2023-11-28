<?php

namespace App\Domain\Roles\Repository;

use App\Factory\QueryFactory;

final class RolesFinderRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function findRoless(): array
    {
        $query = $this->queryFactory->newSelect('roles');

        $query->select(
            [
                'roles.id',
                'roles.rol'
            ]

        );
        return $query->execute()->fetchAll('assoc') ?: [];
    }
}
