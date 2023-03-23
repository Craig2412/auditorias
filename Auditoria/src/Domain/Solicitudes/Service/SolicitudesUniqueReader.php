<?php

namespace App\Domain\Solicitudes\Service;

use App\Domain\Solicitudes\Data\SolicitudesUniqueReaderResult;
use App\Domain\Solicitudes\Repository\SolicitudesUniqueRepository;



final class SolicitudesUniqueReader
{
    private SolicitudesUniqueRepository $repository;

    /**
     * The constructor.
     *
     * @param SolicitudesUniqueRepository $repository The repository
     */
    public function __construct(SolicitudesUniqueRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a solicitudesUnique.
     *
     * @param int $solicitudesUniqueId The solicitudesUnique id
     *
     * @return SolicitudesUniqueReaderResult The result
     */
    public function getSolicitudesUnique(int $solicitudesUniqueId): SolicitudesUniqueReaderResult
    {
        // Input validation
        // ...

        // Fetch data from the database
        $solicitudesUniqueRow = $this->repository->getSolicitudesUniqueById($solicitudesUniqueId);



        // Optional: Add or invoke your complex business logic here
        // ...

        // Create domain result
        $result = new SolicitudesUniqueReaderResult();
        $result->id = $solicitudesUniqueRow[0]['id'];
        $result->num_request = $solicitudesUniqueRow[0]['num_request'];
        $result->num_registry = $solicitudesUniqueRow[0]['num_registry'];
        $result->approach = $solicitudesUniqueRow[0]['approach'];
        $result->response = $solicitudesUniqueRow[0]['response'];
        $result->company = $solicitudesUniqueRow[0]['name'];
        $result->category = $solicitudesUniqueRow[0]['category'];
        $result->condition = $solicitudesUniqueRow[0]['condition'];
        $result->status = $solicitudesUniqueRow[0]['status'];
        $result->updated = $solicitudesUniqueRow[0]['updated'];


        return $result;
    }
}
