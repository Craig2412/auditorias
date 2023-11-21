<?php

namespace App\Domain\Workers\Service;

use App\Domain\Workers\Repository\WorkersRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

final class WorkersCreator
{
    private WorkersRepository $repository;

    private WorkersValidator $workersValidator;

    private LoggerInterface $logger;

    public function __construct(
        WorkersRepository $repository,
        WorkersValidator $workersValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->workersValidator = $workersValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('workers_creator.log')
            ->createLogger();
    }

    public function createWorkers(array $data): int
    {
        // Input validation
        $this->workersValidator->validateWorkers($data);

        // Insert workers and get new workers ID
        $workersId = $this->repository->insertWorkers($data);

        // Logging
        $this->logger->info(sprintf('Workers created successfully: %s', $workersId));

        return $workersId;
    }
}
