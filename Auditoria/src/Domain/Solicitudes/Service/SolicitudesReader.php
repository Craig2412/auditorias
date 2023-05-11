<?php

namespace App\Domain\Solicitudes\Service;

use App\Domain\Solicitudes\Data\SolicitudesReaderResult;
use App\Domain\Solicitudes\Repository\SolicitudesRepository;

/**
 * Service.
 */
final class SolicitudesReader
{
    private SolicitudesRepository $repository;

    /**
     * The constructor.
     *
     * @param SolicitudesRepository $repository The repository
     */
    public function __construct(SolicitudesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a solicitudes.
     *
     * @param int $solicitudesId The solicitudes id
     *
     * @return SolicitudesReaderResult The result
     */
    public function getSolicitudes(int $solicitudesId): SolicitudesReaderResult
    {
              // Input validation
        // ...

        // Fetch data from the database
        $solicitudesRow = $this->repository->getSolicitudesById($solicitudesId);
        //var_dump($solicitudesRow);
        // Optional: Add or invoke your complex business logic here
        $result = new SolicitudesReaderResult();
        // Create domain result
        foreach ($solicitudesRow as $solicitudRows) {
            $sol = new SolicitudesReaderResult();
            $sol->id = $solicitudRows['id'];
            $sol->num_request = $solicitudRows['num_request'];
            $sol->num_registry = $solicitudRows['num_registry'];
            $sol->approach = $solicitudRows['approach'];
            $sol->response = $solicitudRows['response'];
            $sol->category = $solicitudRows['category'];
            $sol->condition = $solicitudRows['condition'];
            $sol->status = $solicitudRows['status'];
            $sol->updated = $solicitudRows['updated'];

            $result->solicitudes[] = $sol;
        }
       // var_dump($result);
        return $result;
    }
}
