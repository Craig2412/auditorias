<?php

namespace App\Domain\Requerimientos\Repository;

use App\Factory\QueryFactory;

final class RequerimientoslistaxEstadosFinderRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function findRequerimientoslistaxEstados(): array
    {
        
        $query = $this->queryFactory->newSelect('requerimientos');
        $query->select([
            'total' => $query->func()->count('*'),
            'estados.estado'
        ])
        ->leftJoin('estados', 'estados.id = requerimientos.id_estado')
        ->group('requerimientos.id_estado');

        $query->where(['requerimientos.id_condicion' => 1]);

        return $query->execute()->fetchAll('assoc') ?: [];
    }
}
