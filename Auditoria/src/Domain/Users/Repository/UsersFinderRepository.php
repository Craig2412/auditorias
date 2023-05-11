<?php

namespace App\Domain\Users\Repository;

use App\Factory\QueryFactory;

final class UsersFinderRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function findUsers(): array
    {
        $query = $this->queryFactory->newSelect('users');

        $query->select(
            [
                'users.id',
                'users.name',
                'users.surname',
                'users.email',
                'users.identification',
                'users.pass',
                'users.phone',
                'roles.role',
                'conditions.condition',
                'users.created',
                'users.updated'
            ]
        )  
        ->leftjoin(['conditions'=>'conditions'], 'conditions.id = users.id_condition')
        ->leftjoin(['roles'=>'roles'], 'roles.id = users.id_role');

        return $query->execute()->fetchAll('assoc') ?: [];
    }
}
