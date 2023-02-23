<?php

namespace App\Domain\Solicitudes\Service;

use App\Domain\Solicitudes\Data\SolicitudesFinderItem;
use App\Domain\Solicitudes\Data\SolicitudesFinderResult;
use App\Domain\Solicitudes\Repository\SolicitudesFinderRepository;

final class SolicitudesFinder
{
    private SolicitudesFinderRepository $repository;

    public function __construct(SolicitudesFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findSolicitudes(): SolicitudesFinderResult
    {
        // Input validation
        // ...

        $solicitudes = $this->repository->findSolicitudes();

        return $this->createResult($solicitudes);
    }

    private function createResult(array $solicitudRows): SolicitudesFinderResult
    {
        $result = new SolicitudesFinderResult();

        foreach ($solicitudRows as $solicitudRow) {
            $solicitud = new SolicitudesFinderItem();
            $solicitud->id = $solicitudRow['id'];
            $solicitud->num_request = $solicitudRow['num_request'];
            $solicitud->num_registry = $solicitudRow['num_registry'];
            $solicitud->approach = $solicitudRow['approach'];
            $solicitud->response = $solicitudRow['response'];
            $solicitud->company = $solicitudRow['name'];
            $solicitud->category = $solicitudRow['category'];
            $solicitud->condition = $solicitudRow['condition'];
            $solicitud->status = $solicitudRow['status'];
            $solicitud->updated = $solicitudRow['updated'];

            $result->solicitudes[] = $solicitud;
        }

        return $result;
    }
}
