<?php

namespace App\Domain\Status\Repository;

use App\Factory\QueryFactory;
use DomainException;

final class StatusRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
        $this->fecha = date("d-m-Y H:i:s" , time() - 18000); // Aca esta la fecha del dia (UNIX) menos 5  horas por el uso horario de venezuela

    }

    public function insertStatus(array $status): int
    {
        return (int)$this->queryFactory->newInsert('status', $this->toRow($status))
            ->execute()
            ->lastInsertId();
    }

    public function getStatusById(int $statusId): array
    {
        $query = $this->queryFactory->newSelect('status');
        $query->select(
            [
                'status.id',
                'format_appointment.format_appointment',
                'users.name',
                'users.surname',
                'state.status',
                'status.created',
                'status.updated'
            ]
        );

        $query->where(['status.id' => $statusId]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('Status not found: %s', $statusId));
        }

        return $row;
    }

    public function updateStatus(int $statusId, array $status): void
    {
        $row = $this->toRow($status);

        $this->queryFactory->newUpdate('status', $row)
            ->where(['id' => $statusId])
            ->execute();
    }

    public function existsStatusId(int $statusId): bool
    {
        $query = $this->queryFactory->newSelect('status');
        $query->select('id')->where(['id' => $statusId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    public function deleteStatusById(int $statusId): void
    {
        $this->queryFactory->newDelete('status')
            ->where(['id' => $statusId])
            ->execute();
    }

    private function toRow(array $status): array
    {
        return [
            'status' => $status['status'],
            'status_number' => $status['status_number'],
            'id_grouping' => $status['id_grouping'],
            'id_condition' => 1,
            'created' => $this->fecha,
            'updated' => null
           
        ];
    }
}
