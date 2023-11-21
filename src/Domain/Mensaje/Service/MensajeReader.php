<?php

namespace App\Domain\Mensaje\Service;

use App\Domain\Mensaje\Data\MensajeReaderResult;
use App\Domain\Mensaje\Repository\MensajeRepository;

/**
 * Service.
 */
final class MensajeReader
{
    private MensajeRepository $repository;

    /**
     * The constructor.
     *
     * @param MensajeRepository $repository The repository
     */
    public function __construct(MensajeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a mensaje.
     *
     * @param int $mensajeId The mensaje id
     *
     * @return MensajeReaderResult The result
     */
    public function getMensaje(int $mensajeId): MensajeReaderResult
    {
        // Input validation
        // ...

        // Fetch data from the database
        $mensajeRow = $this->repository->getMensajeById($mensajeId);

        // Optional: Add or invoke your complex business logic here
        // ...
        // Create domain result
        $result = new MensajeReaderResult();
            $result->id = $mensajeRow['id'];
            $result->mensaje = $mensajeRow['mensaje'];
            $result->id_usuario = $mensajeRow['id_usuario'];
            $result->nombre = $mensajeRow['nombre'];
            $result->id_solicitud = $mensajeRow['id_solicitud'];
            $result->titulo = $mensajeRow['titulo'];
            $result->created = $mensajeRow['created'];
            $result->updated = $mensajeRow['updated'];

            
        return $result;
    }
}
