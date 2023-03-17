<?php

namespace App\Domain\Solicitudes\Service;

use App\Domain\Solicitudes\Repository\SolicitudesRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

final class SolicitudesCreator
{
    private SolicitudesRepository $repository;

    private SolicitudesValidator $solicitudesValidator;

    private LoggerInterface $logger;

    public function __construct(
        SolicitudesRepository $repository,
        SolicitudesValidator $solicitudesValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->solicitudesValidator = $solicitudesValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('solicitudes_creator.log')
            ->createLogger();
    }

    public function createSolicitudes(array $data): int
    {
        // Input validation
        for ($i=0; $i < count($data) ; $i++) { 
            $this->solicitudesValidator->validateSolicitudes($data[$i]);
        }

        // Insert solicitudes and get new solicitudes ID
        for ($i=0; $i < count($data) ; $i++) { 
            $solicitudesId = $this->repository->insertSolicitudes($data[$i]);
        }
        
        // Logging
        $this->logger->info(sprintf('Solicitudes created successfully: %s', $solicitudesId));

        return $solicitudesId;
    }
}
