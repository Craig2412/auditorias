<?php

namespace App\Domain\Solicitudes\Repository;

use App\Factory\QueryFactory;

final class SolicitudesFinderRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function findSolicitudes(): array
    {
        $query = $this->queryFactory->newSelect('requests');

        $query->select(
            [
                'requests.id',
                'requests.num_request',
                'requests.num_registry',
                'requests.approach',
                'requests.response',
                'companies.name',
                'category.category',
                'condition.condition',
                'state.status',
                'requests.updated'
            ]
        )   ->leftjoin(['companies'=>'companies'], 'companies.id = requests.id_company_represented')
            ->leftjoin(['category'=>'categories'], 'category.id = requests.id_category')
            ->leftjoin(['condition'=>'conditions'], 'condition.id = requests.id_condition')
            ->leftjoin(['state'=>'status'], 'state.id = requests.id_status');

       

        // Add more "use case specific" conditions to the query
        // ...

        return $query->execute()->fetchAll('assoc') ?: [];
    }
}
