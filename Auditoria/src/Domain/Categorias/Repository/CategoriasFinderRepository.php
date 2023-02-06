<?php

namespace App\Domain\Categorias\Repository;

use App\Factory\QueryFactory;

final class CategoriasFinderRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function findCategorias(): array
    {
        $query = $this->queryFactory->newSelect('categorias');

        $query->select(
            [
                'id',
                'categoria',
                'id_condicion',
                'id_departamento',
                'created',
                'updated'
            ]
        );

        return $query->execute()->fetchAll('assoc') ?: [];
    }
}
