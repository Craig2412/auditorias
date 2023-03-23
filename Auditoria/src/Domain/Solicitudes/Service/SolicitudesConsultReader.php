<?php

namespace App\Domain\Solicitudes\Service;

use App\Domain\Solicitudes\Data\SolicitudesConsultReaderResult;
use App\Domain\Solicitudes\Repository\SolicitudesConsultRepository;



final class SolicitudesConsultReader
{
    private SolicitudesConsultRepository $repository;

    /**
     * The constructor.
     *
     * @param SolicitudesConsultRepository $repository The repository
     */
    public function __construct(SolicitudesConsultRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a solicitudesConsult.
     *
     * @param int $solicitudesConsultId The solicitudesConsult id
     *
     * @return SolicitudesConsultReaderResult The result
     */
    public function getSolicitudesConsult(int $solicitudesConsultId): SolicitudesConsultReaderResult
    {
        // Input validation

        // Fetch data from the database
        $solicitudesConsultRow = $this->repository->connectingSipi($solicitudesConsultId);

        // Create domain result
        if ($solicitudesConsultRow != null) {
            $result = new SolicitudesConsultReaderResult();
            $result->nombre = trim($solicitudesConsultRow['nombre']);
            $result->estatus = $solicitudesConsultRow['estatus'];
            $result->nro_derecho = $solicitudesConsultRow['nro_derecho'];
            $result->solicitud = $solicitudesConsultRow['solicitud'];
            return $result;
        }else {
            $result = new SolicitudesConsultReaderResult();
            $result->nombre = null;
            $result->estatus = null;
            $result->nro_derecho = null;
            $result->solicitud = null;
            return $result;
        }
       
    }
}
