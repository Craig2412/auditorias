<?php

namespace App\Domain\Categories\Repository;

use App\Factory\QueryFactory;

final class CategoriesFinderRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function findCategories(): array
    {
        $query = $this->queryFactory->newSelect('categories');

        $query->select(
            [
                'categories.id',
                'categories.category',
                'condition.condition',
                'department.deparment',
                'categories.created',
                'categories.updated'
            ]
        )->leftjoin(['department'=>'deparments'],'department.id = categories.id_deparment')
         ->leftjoin(['condition'=>'conditions'], 'condition.id = categories.id_condition');

        return $query->execute()->fetchAll('assoc') ?: [];
    }
}
