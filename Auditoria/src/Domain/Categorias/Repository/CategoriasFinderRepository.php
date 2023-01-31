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
                'id_departamento'   
            ]
        );

        // Add more "use case specific" conditions to the query
        // ...

        return $query->execute()->fetchAll('assoc') ?: [];
    }
}
