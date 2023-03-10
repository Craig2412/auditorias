<?php

namespace App\Domain\Categories\Repository;

use App\Factory\QueryFactory;
use DomainException;

final class CategoriesRepositoryUpdate
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
        $this->fecha = date("d-m-Y H:i:s" , time() - 18000);// Aca esta la fecha del dia (UNIX) menos 5  horas por el uso horario de venezuela
    }

    public function insertCategories(array $categories): int
    {
        return (int)$this->queryFactory->newInsert('categories', $this->toRow($categories))
            ->execute()
            ->lastInsertId();
    }

    public function updateCategories(int $categoriesId, array $categories): array
    {
        $row = $this->toRow($categories);
        $this->queryFactory->newUpdate('categories', $row)
            ->where(['id' => $categoriesId])
            ->execute();
            return $row;
    }

    public function existsCategoriesId(int $categoriesId): bool
    {
        $query = $this->queryFactory->newSelect('categories');
        $query->select('id')->where(['id' => $categoriesId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    private function toRow(array $categories): array
    {
        return [
            'category' => $categories['category'],
            'id_deparment' => $categories['id_deparment'],
            'updated' => $this->fecha
        ];
    }
}
