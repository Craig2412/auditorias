<?php

namespace App\Domain\Categories\Service;

use App\Domain\Categories\Repository\CategoriesRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

final class CategoriesCreator
{
    private CategoriesRepository $repository;

    private CategoriesValidator $categoriesValidator;

    private LoggerInterface $logger;

    public function __construct(
        CategoriesRepository $repository,
        CategoriesValidator $categoriesValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->categoriesValidator = $categoriesValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('categories_creator.log')
            ->createLogger();
    }

    public function createCategories(array $data): int
    {
        // Input validation
        $this->categoriesValidator->validateCategories($data);

        // Insert categories and get new categories ID
        $categoriesId = $this->repository->insertCategories($data);

        // Logging
        $this->logger->info(sprintf('Categories created successfully: %s', $categoriesId));

        return $categoriesId;
    }
}
