<?php

namespace App\Domain\Status\Repository;

use App\Factory\QueryFactory;

final class StatusFinderRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function findStatus($tipo_status): array
    {
        $query = $this->queryFactory->newSelect('status');

        $query->select(
            [
                'status.id',
                'status.status',
                'status.status_number',
                'groupings.grouping',
                'conditions.condition',
                'status.created',
                'status.updated'
            ]
        )  
        ->leftjoin(['conditions'=>'conditions'], 'conditions.id = status.id_condition')
        ->leftjoin(['groupings'=>'groupings'], 'groupings.id = status.id_grouping');
        
        $query->where(['groupings.grouping' => "$tipo_status"]);

        return $query->execute()->fetchAll('assoc') ?: [];
    }
}
