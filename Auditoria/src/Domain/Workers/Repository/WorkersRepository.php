<?php

namespace App\Domain\Workers\Repository;

use App\Factory\QueryFactory;
use DomainException;

final class WorkersRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
        $this->fecha = date("d-m-Y H:i:s" , time() - 18000); // Aca esta la fecha del dia (UNIX) menos 5  horas por el uso horario de venezuela

    }

    public function insertWorkers(array $workers): int
    {
        return (int)$this->queryFactory->newInsert('workers', $this->toRow($workers))
            ->execute()
            ->lastInsertId();
    }

    public function getWorkersById(int $workersId): array
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

        $query->where(['workers.id' => $workersId]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('Workers not found: %s', $workersId));
        }

        return $row;
    }

    public function updateWorkers(int $workersId, array $workers): void
    {
        $row = $this->toRow($workers);

        $this->queryFactory->newUpdate('workers', $row)
            ->where(['id' => $workersId])
            ->execute();
    }

    public function existsWorkersId(int $workersId): bool
    {
        $query = $this->queryFactory->newSelect('workers');
        $query->select('id')->where(['id' => $workersId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    public function deleteWorkersById(int $workersId): void
    {
        $this->queryFactory->newDelete('workers')
            ->where(['id' => $workersId])
            ->execute();
    }

    private function toRow(array $workers): array
    {
        return [
            'id_charge' => $workers['id_charge'],
            'id_user' => $workers['id_user'],
            'id_status' => $workers['id_status'],
            'id_deparment' => $workers['id_deparment'],
            'created' => $this->fecha,
            'updated' => null
           
        ];
    }
}
