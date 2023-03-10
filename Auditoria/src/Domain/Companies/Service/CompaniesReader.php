<?php

namespace App\Domain\Companies\Service;

use App\Domain\Companies\Data\CompaniesReaderResult;
use App\Domain\Companies\Repository\CompaniesRepository;

/**
 * Service.
 */
final class CompaniesReader
{
    private CompaniesRepository $repository;

    /**
     * The constructor.
     *
     * @param CompaniesRepository $repository The repository
     */
    public function __construct(CompaniesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a company.
     *
     * @param int $companyId The company id
     *
     * @return CompaniesReaderResult The result
     */
    public function getCompanies(int $companyId): CompaniesReaderResult
    {
        // Input validation
        // ...

        // Fetch data from the database
        $companyRow = $this->repository->getCompaniesById($companyId);

        // Optional: Add or invoke your complex business logic here
        // ...

        // Create domain result
        $result = new CompaniesReaderResult();
        $result->id = $companyRow['id'];
        $result->name = $companyRow['name'];
        $result->rif = $companyRow['rif'];
        $result->signature = $companyRow['signature'];

        return $result;
    }
}
