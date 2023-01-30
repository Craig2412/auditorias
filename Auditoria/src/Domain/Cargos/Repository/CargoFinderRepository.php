<?php

namespace App\Domain\Cargos\Repository;

use App\Factory\QueryFactory;

final class CargoFinderRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function findCustomers(): array
    {
        $query = $this->queryFactory->newSelect('cargos');

        $query->select(
            [
                'id',
                'cargo'
                
            ]
        );

        // Add more "use case specific" conditions to the query
        // ...

        return $query->execute()->fetchAll('assoc') ?: [];
    }
}
