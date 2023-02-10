<?php

namespace App\Domain\Categories\Repository;

use App\Factory\QueryFactory;
use DomainException;

final class CategoriesRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
        $this->fecha = date("d-m-Y H:i:s" , time() - 18000); // Aca esta la fecha del dia (UNIX) menos 5  horas por el uso horario de venezuela
    }

    public function insertCategories(array $categories): int
    {
        return (int)$this->queryFactory->newInsert('categories', $this->toRow($categories))
            ->execute()
            ->lastInsertId();
    }

    public function getCategoriesById(int $categoriesId): array
    {
        $query = $this->queryFactory->newSelect('categories');
        $query->select(
            [
                'categories.id',
                'categories.category',
                'conditions.condition',
                'department.deparment',
                'categories.created',
                'categories.updated'
            ]
        )->leftjoin(['department'=>'deparments'],'department.id = categories.id_deparment')
         ->leftjoin(['condition'=>'conditions'], 'condition.id = categories.condition');;

        $query->where(['id' => $categoriesId]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('Categories not found: %s', $categoriesId));
        }

        return $row;
    }

    public function updateCategories(int $categoriesId, array $categories): void
    {
        $row = $this->toRow($categories);

        $this->queryFactory->newUpdate('categories', $row)
            ->where(['id' => $categoriesId])
            ->execute();
    }

    public function existsCategoriesId(int $categoriesId): bool
    {
        $query = $this->queryFactory->newSelect('categories');
        $query->select('id')->where(['id' => $categoriesId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    public function deleteCategoriesById(int $categoriesId): void
    {
        $this->queryFactory->newDelete('categories')
            ->where(['id' => $categoriesId])
            ->execute();
    }

    private function toRow(array $categories): array
    {
        return [
            'category' => $categories['category'],
            'id_condition' => $categories['id_condition'],
            'id_deparment' => $categories['id_deparment'],
            'created' => $this->fecha,
            'updated' =>null
        ];
    }
}
