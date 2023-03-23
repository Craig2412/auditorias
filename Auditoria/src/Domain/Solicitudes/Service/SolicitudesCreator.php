<?php

namespace App\Domain\Solicitudes\Service;

use App\Domain\Solicitudes\Repository\SolicitudesRepository;
use App\Domain\Solicitudes\Repository\SolicitudesConsultRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

final class SolicitudesCreator
{
    private SolicitudesRepository $repository;

    private SolicitudesValidator $solicitudesValidator;

    private LoggerInterface $logger;

    public function __construct(SolicitudesRepository $repository, SolicitudesValidator $solicitudesValidator, LoggerFactory $loggerFactory) {
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
            $sipi = New conexionSipi;

            $validatorRequest = $sipi->connecting($data[$i]['num_request']);

            if ($validatorRequest != null) {
                $data[$i]['id_category'] = $validator['estatus'];
                $data[$i]['num_registry'] = $validator['nro_derecho'];
                $data[$i]['name'] = $validator['name'];
                $solicitudesId = $this->repository->insertSolicitudes($data[$i]);
            }else {
                //retornar algun print de error y que se graben las demas solicitudes, o retornar un print de error y que no se grabe mas nada a partir de aca
            }
        }
        
        // Logging
        $this->logger->info(sprintf('Solicitudes created successfully: %s', $solicitudesId));

        return $solicitudesId;
    }
}
