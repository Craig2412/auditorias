<?php

namespace App\Domain\Companies\Service;

use App\Domain\Companies\Repository\CompaniesRepositoryUpdate;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

final class CompaniesUpdater
{
    private CompaniesRepositoryUpdate $repositoryUpdate;

    private CompaniesValidatorUpdate $companiesValidatorUpdate;

    private LoggerInterface $logger;

    public function __construct(
        CompaniesRepositoryUpdate $repositoryUpdate,
        CompaniesValidatorUpdate $companiesValidatorUpdate,
        LoggerFactory $loggerFactory
    ) {
        $this->repositoryUpdate = $repositoryUpdate;
        $this->companiesValidatorUpdate = $companiesValidatorUpdate;
        $this->logger = $loggerFactory
            ->addFileHandler('companies_updater.log')
            ->createLogger();
    }

    public function updateCompanies(int $companiesId, array $data): array
    {
        // Input validation
        $this->companiesValidatorUpdate->validateCompaniesUpdate($companiesId, $data);

        // Update the row
        $var = $this->repositoryUpdate->updateCompanies($companiesId, $data);
        

        // Logging
        $this->logger->info(sprintf('Companies updated successfully: %s', $companiesId));

        return $var;
    }
}
