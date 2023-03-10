<?php

namespace App\Domain\Companies\Repository;

use App\Factory\QueryFactory;

final class CompaniesFinderRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function findCompanies(): array
    {
        $query = $this->queryFactory->newSelect('companies');

        $query->select(
            [
                'id',
                'name',
                'rif',
                'signature'                
            ]
        );

        // Add more "use case specific" conditions to the query
        // ...

        return $query->execute()->fetchAll('assoc') ?: [];
    }
}
