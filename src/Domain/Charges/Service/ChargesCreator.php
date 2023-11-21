<?php

namespace App\Domain\Charges\Service;

use App\Domain\Charges\Repository\ChargesRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

final class ChargesCreator
{
    private ChargesRepository $repository;

    private ChargesValidator $chargesValidator;

    private LoggerInterface $logger;

    public function __construct(
        ChargesRepository $repository,
        ChargesValidator $chargesValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->chargesValidator = $chargesValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('charges_creator.log')
            ->createLogger();
    }

    public function createCharges(array $data): int
    {
        // Input validation
        $this->chargesValidator->validateCharges($data);

        // Insert charges and get new charges ID
        $chargesId = $this->repository->insertCharges($data);

        // Logging
        $this->logger->info(sprintf('Charges created successfully: %s', $chargesId));

        return $chargesId;
    }
}
