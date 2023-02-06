<?php

namespace App\Domain\Categoria\Repository;

use App\Factory\QueryFactory;
use DomainException;

final class CategoriaRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function insertCategoria(array $categoria): int
    {
        return (int)$this->queryFactory->newInsert('categorias', $this->toRow($categoria))
            ->execute()
            ->lastInsertId();
    }

    public function getCategoriaById(int $categoriaId): array
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

        $query->where(['id' => $categoriaId]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('Categoria not found: %s', $categoriaId));
        }

        return $row;
    }

    public function updateCategoria(int $categoriaId, array $categoria): void
    {
        $row = $this->toRow($categoria);

        $this->queryFactory->newUpdate('categorias', $row)
            ->where(['id' => $categoriaId])
            ->execute();
    }

    public function existsCategoriaId(int $categoriaId): bool
    {
        $query = $this->queryFactory->newSelect('categorias');
        $query->select('id')->where(['id' => $categoriaId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    public function deleteCategoriaById(int $categoriaId): void
    {
        $this->queryFactory->newDelete('categorias')
            ->where(['id' => $categoriaId])
            ->execute();
    }

    private function toRow(array $categoria): array
    {
        return [
            'id' => $categoria['id'],
            'categoria' => $categoria['categoria'],
            'id_condicion' => $categoria['street'],
            'id_departamento' => $categoria['id_departamento'],
            'created' => $categoria['created'],
            'updated' => $categoria['updated']
        ];
    }
}
