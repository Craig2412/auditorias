<?php

namespace App\Domain\Estados\Repository;

use App\Factory\QueryFactory;

final class EstadosFinderRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function findEstadoss(): array
    {
        $query = $this->queryFactory->newSelect('estados');

        $query->select(
            [
                'estados.id',
                'estados.estado',
                'estados.id_agrupacion',
                'agrupaciones.agrupacion'
            ]

        )
        ->leftjoin(['agrupaciones'=>'agrupaciones'], 'agrupaciones.id = estados.id_agrupacion');

        $query->where(['estados.id_condicion' => 1]);


        return $query->execute()->fetchAll('assoc') ?: [];
    }
}
