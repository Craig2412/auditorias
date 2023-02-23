<?php

namespace App\Domain\Solicitudes\Repository;

use App\Factory\QueryFactory;
use DomainException;

final class SolicitudesUniqueRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->fecha = date("d-m-Y H:i:s" , time() - 18000); // Aca esta la fecha del dia (UNIX) menos 5  horas por el uso horario de venezuela
        $this->queryFactory = $queryFactory;
    }

    public function insertSolicitudesUnique(array $solicitudesUnique): int
    {
        return (int)$this->queryFactory->newInsert('requests', $this->toRow($solicitudesUnique))
            ->execute()
            ->lastInsertId();
    }

    public function getSolicitudesUniqueById(int $solicitudesUniqueId): array
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

        $query->where(['requests.id' => $solicitudesUniqueId]);
         

        $row = $query->execute()->fetchAll('assoc');
        if (!$row) {
            throw new DomainException(sprintf('SolicitudesUnique not found: %s', $solicitudesUniqueId));
        }

        return $row;
    }

    public function updateSolicitudesUnique(int $solicitudesUniqueId, array $solicitudesUnique): void
    {
        $row = $this->toRow($solicitudesUnique);

        $this->queryFactory->newUpdate('requests', $row)
            ->where(['id' => $solicitudesUniqueId])
            ->execute();
    }

    public function existsSolicitudesUniqueId(int $solicitudesUniqueId): bool
    {
        $query = $this->queryFactory->newSelect('requests');
        $query->select('id')->where(['id_requirement' => $solicitudesUniqueId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    public function deleteSolicitudesUniqueById(int $solicitudesUniqueId): void
    {
        $this->queryFactory->newDelete('requests')
            ->where(['id' => $solicitudesUniqueId])
            ->execute();
    }

    private function toRow(array $solicitudesUnique): array
    {
        return [
            'num_request' => $solicitudesUnique['num_request'],
            'num_registry' => $solicitudesUnique['num_registry'],
            'approach' => $solicitudesUnique['approach'],
            'response' => $solicitudesUnique['response'],
            'id_company_represented' => $solicitudesUnique['id_company_represented'],
            'id_category' => $solicitudesUnique['id_category'],
            'id_requirement' => $solicitudesUnique['id_requirement'],
            'id_condition' =>1,
            'id_status' => 6,
            'created' => $this->fecha,
            'updated' => null
        ];
    }
}