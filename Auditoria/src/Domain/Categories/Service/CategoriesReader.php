<?php

namespace App\Domain\Category\Service;

use App\Domain\Category\Data\CategoryReaderResult;
use App\Domain\Category\Repository\CategoryRepository;

/**
 * Service.
 */
final class CategoryReader
{
    private CategoryRepository $repository;

    /**
     * The constructor.
     *
     * @param CategoryRepository $repository The repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a category.
     *
     * @param int $categoryId The category id
     *
     * @return CategoryReaderResult The result
     */
    public function getCategory(int $categoryId): CategoryReaderResult
    {
        // Input validation
        // ...

        // Fetch data from the database
        $categoryRow = $this->repository->getCategoryById($categoryId);

        // Optional: Add or invoke your complex business logic here
        // ...

        // Create domain result
        $result = new CategoryReaderResult();
        $result->id = $categoryRow['id'];
        $result->category = $categoryRow['category'];
        $result->id_condition = $categoryRow['id_condicion'];
        $result->id_deparment = $categoryRow['id_deparment'];
        $result->created = $categoryRow['created'];
        $result->updated = $categoryRow['updated'];

        return $result;
    }
}