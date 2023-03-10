<?php

namespace App\Domain\Solicitudes\Repository;

use App\Factory\QueryFactory;
use DomainException;

final class SolicitudesRepositoryUpdate
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
        $this->fecha = date("d-m-Y H:i:s" , time() - 18000); // Aca esta la fecha del dia (UNIX) menos 5  horas por el uso horario de venezuela
    }

    public function updateSolicitudes(int $solicitudesId, array $solicitudes): array
    {
        $row = $this->toRow($solicitudes);
        $this->queryFactory->newUpdate('requests', $row)
            ->where(['id' => $solicitudesId])
            ->execute();
            return $row;
    }

    public function existsSolicitudesId(int $solicitudesId): bool
    {
        $query = $this->queryFactory->newSelect('requests');
        $query->select('id')->where(['id' => $solicitudesId]);
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
            'id_status' => $solicitudes['id_status'],
            'updated' => $this->fecha
        ];
    }
}
