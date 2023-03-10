<?php

namespace App\Domain\Solicitudes\Service;

use App\Domain\Solicitudes\Repository\SolicitudesRepositoryUpdate;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

final class SolicitudesUpdater
{
    private SolicitudesRepositoryUpdate $repositoryUpdate;

    private SolicitudesValidatorUpdate $solicitudesValidatorUpdate;

    private LoggerInterface $logger;

    public function __construct(
        SolicitudesRepositoryUpdate $repositoryUpdate,
        SolicitudesValidatorUpdate $solicitudesValidatorUpdate,
        LoggerFactory $loggerFactory
    ) {
        $this->repositoryUpdate = $repositoryUpdate;
        $this->solicitudesValidatorUpdate = $solicitudesValidatorUpdate;
        $this->logger = $loggerFactory
            ->addFileHandler('solicitudes_updater.log')
            ->createLogger();
    }

    public function updateSolicitudes(int $solicitudesId, array $data): array
    {
        // Input validation
        $this->solicitudesValidatorUpdate->validateSolicitudesUpdate($solicitudesId, $data);

        // Update the row
        $var = $this->repositoryUpdate->updateSolicitudes($solicitudesId, $data);
        

        // Logging
        $this->logger->info(sprintf('Solicitudes updated successfully: %s', $solicitudesId));

        return $var;
    }
}
