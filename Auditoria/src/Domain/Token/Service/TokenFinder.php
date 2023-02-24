<?php

namespace App\Domain\Token\Service;

use App\Domain\Token\Repository\TokenRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;
use App\Auth\Auth;

final class TokenFinder
{
    private TokenRepository $repository;

    private LoggerInterface $logger;

    public function __construct(
        TokenRepository $repository,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->logger = $loggerFactory
            ->addFileHandler('user_creator.log')
            ->createLogger();
    }

    public function finderToken(int $id): array
    {
        // Insert customer and get new customer ID
        $token = $this->repository->getTokenByUser($id);

        // Logging
        $this->logger->info(sprintf('Token created successfully: %s', $id));

        return $token;
    }
}