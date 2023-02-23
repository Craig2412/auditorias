<?php

namespace App\Domain\Workers\Repository;

use App\Factory\QueryFactory;

final class WorkersFinderRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function findWorkers(): array
    {
        $query = $this->queryFactory->newSelect('workers');

        $query->select(
            [
                'workers.id',
                'charge.charge',
                'users.name',
                'users.surname',
                'state.status',
                'deparment.deparment',
                'workers.created',
                'workers.updated'
            ]
        )  
        ->leftjoin(['charge'=>'charges'], 'charge.id = workers.id_charge')
        ->leftjoin(['users'=>'users'], 'users.id = workers.id_user')
        ->leftjoin(['state'=>'status'], 'state.id = workers.id_status')
        ->leftjoin(['deparment'=>'deparments'],'deparment.id = workers.id_deparment');

        return $query->execute()->fetchAll('assoc') ?: [];
    }
}
