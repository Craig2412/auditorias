<?php

namespace App\Domain\Workers\Service;

use App\Domain\Workers\Repository\WorkersRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

final class WorkersUpdater
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
            ->addFileHandler('workers_updater.log')
            ->createLogger();
    }

    public function updateWorkers(int $workersId, array $data): void
    {
        // Input validation
        $this->workersValidator->validateWorkersUpdate($workersId, $data);

        // Update the row
        $this->repository->updateWorkers($workersId, $data);

        // Logging
        $this->logger->info(sprintf('Workers updated successfully: %s', $workersId));
    }
}
