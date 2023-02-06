<?php

namespace App\Domain\Categorias\Service;

use App\Domain\Categorias\Repository\CategoriasRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

final class CategoriasCreator
{
    private CategoriasRepository $repository;

    private CategoriasValidator $categoriasValidator;

    private LoggerInterface $logger;

    public function __construct(
        CategoriasRepository $repository,
        CategoriasValidator $categoriasValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->categoriasValidator = $categoriasValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('categorias_creator.log')
            ->createLogger();
    }

    public function createCategorias(array $data): int
    {
        // Input validation
        $this->categoriasValidator->validateCategorias($data);

        // Insert categorias and get new categorias ID
        $categoriasId = $this->repository->insertCategorias($data);

        // Logging
        $this->logger->info(sprintf('Categorias created successfully: %s', $categoriasId));

        return $categoriasId;
    }
}
