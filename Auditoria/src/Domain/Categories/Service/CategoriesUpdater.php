<?php

namespace App\Domain\Categories\Service;

use App\Domain\Categories\Repository\CategoriesRepositoryUpdate;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

final class CategoriesUpdater
{
    private CategoriesRepositoryUpdate $repositoryUpdate;

    private CategoriesValidatorUpdate $categoriesValidatorUpdate;

    private LoggerInterface $logger;

    public function __construct(
        CategoriesRepositoryUpdate $repositoryUpdate,
        CategoriesValidatorUpdate $categoriesValidatorUpdate,
        LoggerFactory $loggerFactory
    ) {
        $this->repositoryUpdate = $repositoryUpdate;
        $this->categoriesValidatorUpdate = $categoriesValidatorUpdate;
        $this->logger = $loggerFactory
            ->addFileHandler('categories_updater.log')
            ->createLogger();
    }

    public function updateCategories(int $categoriesId, array $data): array
    {
        // Input validation
        $this->categoriesValidatorUpdate->validateCategoriesUpdate($categoriesId, $data);

        // Update the row
        $var = $this->repositoryUpdate->updateCategories($categoriesId, $data);
        

        // Logging
        $this->logger->info(sprintf('Categories updated successfully: %s', $categoriesId));

        return $var;
    }
}
