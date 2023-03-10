<?php

namespace App\Domain\Companies\Service;

use App\Domain\Companies\Repository\CompaniesRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

final class CompaniesCreator
{
    private CompaniesRepository $repository;

    private CompaniesValidator $companiesValidator;

    private LoggerInterface $logger;

    public function __construct(
        CompaniesRepository $repository,
        CompaniesValidator $companiesValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->companiesValidator = $companiesValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('companies_creator.log')
            ->createLogger();
    }

    public function createCompanies(array $data): int
    {
        // Input validation
        $this->companiesValidator->validateCompanies($data);

        // Insert companies and get new companies ID
        $companiesId = $this->repository->insertCompanies($data);

        // Logging
        $this->logger->info(sprintf('Companies created successfully: %s', $companiesId));

        return $companiesId;
    }
}
