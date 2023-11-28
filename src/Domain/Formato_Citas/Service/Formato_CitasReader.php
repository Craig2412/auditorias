<?php

namespace App\Domain\Formato_Citas\Service;

use App\Domain\Formato_Citas\Data\Formato_CitasReaderResult;
use App\Domain\Formato_Citas\Repository\Formato_CitasRepository;

/**
 * Service.
 */
final class Formato_CitasReader
{
    private Formato_CitasRepository $repository;

    /**
     * The constructor.
     *
     * @param Formato_CitasRepository $repository The repository
     */
    public function __construct(Formato_CitasRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a formato_citas.
     *
     * @param int $formato_citasId The formato_citas id
     *
     * @return Formato_CitasReaderResult The result
     */
    public function getFormato_Citas(int $formato_citasId): Formato_CitasReaderResult
    {
        // Input validation
        // ...

        // Fetch data from the database
        $formato_citasRow = $this->repository->getFormato_CitasById($formato_citasId);

        // Optional: Add or invoke your complex business logic here
        // ...

        // Create domain result
        $result = new Formato_CitasReaderResult();
        $result->id = $formato_citasRow['id'];
        $result->formato_cita = $formato_citasRow['formato_cita'];
        
        return $result;
    }
}