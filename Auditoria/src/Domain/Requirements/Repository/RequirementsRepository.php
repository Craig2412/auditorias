<?php

namespace App\Domain\Requirements\Repository;

use App\Factory\QueryFactory;
use DomainException;

final class RequirementsRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
        $this->fecha = date("d-m-Y H:i:s" , time() - 18000); // Aca esta la fecha del dia (UNIX) menos 5  horas por el uso horario de venezuela

    }

    public function insertRequirements(array $requirements): int
    {
        return (int)$this->queryFactory->newInsert('requirements', $this->toRow($requirements))
            ->execute()
            ->lastInsertId();
    }

    public function getRequirementsById(int $requirementsId): array
    {
        $query = $this->queryFactory->newSelect('requirements');
        $query->select(
            [
                'id',
                'amount_request',
                'id_format_appointment',
                'id_user',
                'id_condition',
                'id_status',
                'id_worker',
                'created',
                'updated'
            ]
        );

        $query->where(['id' => $requirementsId]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('Requirements not found: %s', $requirementsId));
        }

        return $row;
    }

    public function updateRequirements(int $requirementsId, array $requirements): void
    {
        $row = $this->toRow($requirements);

        $this->queryFactory->newUpdate('requirements', $row)
            ->where(['id' => $requirementsId])
            ->execute();
    }

    public function existsRequirementsId(int $requirementsId): bool
    {
        $query = $this->queryFactory->newSelect('requirements');
        $query->select('id')->where(['id' => $requirementsId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    public function deleteRequirementsById(int $requirementsId): void
    {
        $this->queryFactory->newDelete('requirements')
            ->where(['id' => $requirementsId])
            ->execute();
    }

    private function toRow(array $requirements): array
    {
        return [
            'amount_requests' => $requirements['amount_requests'],
            'id_format_appointment' => $requirements['id_format_appointment'],
            'id_user' => $requirements['id_user'],
            'id_condition' => $requirements['id_condition'],
            'id_status' => $requirements['id_status'],
            'id_worker' => $requirements['id_worker'],
            'created' => $this->fecha,
            'updated' => null
           
        ];
    }
}
