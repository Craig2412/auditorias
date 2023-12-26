<?php

namespace App\Domain\Solicitudes\Repository;

use App\Factory\QueryFactory;

final class SolicitudesbyCategoriasFinderRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function findSolicitudesbyCategorias(): array
    {
        
        $query = $this->queryFactory->newSelect('solicitudes');
        $query->select([
            'total' => $query->func()->count('*'),
            'categorias.categoria'
        ])
        ->leftJoin('categorias', 'categorias.id = solicitudes.id_categoria')
        ->group('solicitudes.id_categoria');

        $query->where(['solicitudes.id_condicion' => 1]);

        return $query->execute()->fetchAll('assoc') ?: [];
    }
}
