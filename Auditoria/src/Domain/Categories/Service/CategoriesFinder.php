<?php

namespace App\Domain\Categories\Service;

use App\Domain\Categories\Data\CategoriesFinderItem;
use App\Domain\Categories\Data\CategoriesFinderResult;
use App\Domain\Categories\Repository\CategoriesFinderRepository;

final class CategoriesFinder
{
    private CategoriesFinderRepository $repository;

    public function __construct(CategoriesFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findCategories(): CategoriesFinderResult
    {
        // Input validation
        // ...

        $categories = $this->repository->findCategories();

        return $this->createResult($categories);
    }

    private function createResult(array $categoriesRows): CategoriesFinderResult
    {
        $result = new CategoriesFinderResult();

        foreach ($categoriesRows as $categoriesRow) {
            $categories = new CategoriesFinderItem();
            $categories->id = $categoriesRow['id'];
            $categories->category = $categoriesRow['category'];
            $categories->condition = $categoriesRow['condition'];
            $categories->deparment = $categoriesRow['deparment'];

            $result->categories[] = $categories;
        }

        return $result;
    }
}
