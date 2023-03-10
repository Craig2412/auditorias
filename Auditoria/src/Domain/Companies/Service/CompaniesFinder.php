<?php

namespace App\Domain\Companies\Service;

use App\Domain\Companies\Data\CompaniesFinderItem;
use App\Domain\Companies\Data\CompaniesFinderResult;
use App\Domain\Companies\Repository\CompaniesFinderRepository;

final class CompaniesFinder
{
    private CompaniesFinderRepository $repository;

    public function __construct(CompaniesFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findCompanies(): CompaniesFinderResult
    {
        // Input validation
        // ...

        $companies = $this->repository->findCompanies();

        return $this->createResult($companies);
    }

    private function createResult(array $companyRows): CompaniesFinderResult
    {
        $result = new CompaniesFinderResult();

        foreach ($companyRows as $companyRow) {
            $company = new CompaniesFinderItem();
            $company->id = $companyRow['id'];
            $company->name = $companyRow['name'];
            $company->rif = $companyRow['rif'];
            $company->signature = $companyRow['signature'];

            $result->companies[] = $company;
        }
        return $result;
    }
}
