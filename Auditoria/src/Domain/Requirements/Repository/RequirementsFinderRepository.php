<?php

namespace App\Domain\Requirements\Repository;

use App\Factory\QueryFactory;

final class RequirementsFinderRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function findRequirements(): array
    {
        $query = $this->queryFactory->newSelect('requirements');

        $query->select(
            [
                'requirements.id',
                'format_appointment.format_appointment',
                'users.name',
                'users.surname',
                'worker.id_user',
                'state.status',
                'requirements.created',
                'requirements.updated'
            ]
        )  
        ->leftjoin(['format_appointment'=>'format_appointments'], 'format_appointment.id = requirements.id_format_appointment')
        ->leftjoin(['users'=>'users'], 'users.id = requirements.id_user')
        ->leftjoin(['worker'=>'workers'],'worker.id = users.id')
         ->leftjoin(['state'=>'status'], 'state.id = requirements.id_status');

        return $query->execute()->fetchAll('assoc') ?: [];
    }
}
