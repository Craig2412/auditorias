<?php

namespace App\Domain\Requerimientos\Service;

use App\Domain\Requerimientos\Data\RequerimientosReaderResult;
use App\Domain\Requerimientos\Repository\RequerimientosRepository;

/**
 * Service.
 */
final class RequerimientosReader
{
    private RequerimientosRepository $repository;

    /**
     * The constructor.
     *
     * @param RequerimientosRepository $repository The repository
     */
    public function __construct(RequerimientosRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a requerimientos.
     *
     * @param int $requerimientosId The requerimientos id
     *
     * @return RequerimientosReaderResult The result
     */
    public function getRequerimientos(int $requerimientosId): RequerimientosReaderResult
    {
        // Input validation
        // ...

        // Fetch data from the database
        $requerimientosRow = $this->repository->getRequerimientosById($requerimientosId);

        // Optional: Add or invoke your complex business logic here
        // ...

        // Create domain result
        $result = new RequerimientosReaderResult();
            
            $result->id = $requerimientosRow['id'];
            $result->id_formato_cita = $requerimientosRow['id_formato_cita'];
            $result->formato_cita = $requerimientosRow['formato_cita'];
            $result->id_estado = $requerimientosRow['id_estado'];
            $result->id_condicion = $requerimientosRow['id_condicion'];
            $result->id_usuario = $requerimientosRow['id_usuario'];
            $result->nombre = $requerimientosRow['nombre'];
            $result->apellido = $requerimientosRow['apellido'];
            $result->name = $requerimientosRow['name'];
            $result->identificacion = $requerimientosRow['identificacion'];
            $result->id_pais = $requerimientosRow['id_pais'];
            $result->pais = $requerimientosRow['pais'];
            $result->id_estado_pais = $requerimientosRow['id_estado_pais'];
            $result->estado_pais = $requerimientosRow['estado_pais'];
            $result->id_trabajador = $requerimientosRow['id_trabajador'];
            $result->estado = $requerimientosRow['estado'];
            $result->created = $requerimientosRow['created'];
            $result->updated = $requerimientosRow['updated'];

        return $result;
    }
}
