<?php

namespace App\Domain\Solicitudes\Repository;

use App\Factory\QueryFactory;
use DomainException;

final class SolicitudesRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->fecha = date("d-m-Y H:i:s" , time() - 18000); // Aca esta la fecha del dia (UNIX) menos 5  horas por el uso horario de venezuela
        $this->queryFactory = $queryFactory;
    }

    public function insertSolicitudes(array $solicitudes): int
    {
        return (int)$this->queryFactory->newInsert('requests', $this->toRow($solicitudes))
            ->execute()
            ->lastInsertId();
    }

    public function getSolicitudesById(int $solicitudesId): array
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

        $query->where(['id_requirement' => $solicitudesId]);
         

        $row = $query->execute()->fetchAll('assoc');
        if (!$row) {
            throw new DomainException(sprintf('Solicitudes not found: %s', $solicitudesId));
        }

        return $row;
    }

    public function updateSolicitudes(int $solicitudesId, array $solicitudes): void
    {
        $row = $this->toRow($solicitudes);

        $this->queryFactory->newUpdate('requests', $row)
            ->where(['id' => $solicitudesId])
            ->execute();
    }

    public function existsSolicitudesId(int $solicitudesId): bool
    {
        $query = $this->queryFactory->newSelect('requests');
        $query->select('id')->where(['id_requirement' => $solicitudesId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    public function deleteSolicitudesById(int $solicitudesId): void
    {
        $this->queryFactory->newDelete('requests')
            ->where(['id' => $solicitudesId])
            ->execute();
    }

    private function toRow(array $solicitudes): array
    {
        return [
            'num_request' => $solicitudes['num_request'],
            'num_registry' => $solicitudes['num_registry'],
            'approach' => $solicitudes['approach'],
            'response' => null,
            'id_company_represented' => $solicitudes['id_company_represented'],
            'id_category' => $solicitudes['id_category'],
            'id_requirement' => $solicitudes['id_requirement'],
            'id_condition' =>1,
            'id_status' => 6,
            'created' => $this->fecha,
            'updated' => null
        ];
    }
}