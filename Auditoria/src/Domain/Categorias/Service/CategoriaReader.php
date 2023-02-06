<?php

namespace App\Domain\Categoria\Service;

use App\Domain\Categoria\Data\CategoriaReaderResult;
use App\Domain\Categoria\Repository\CategoriaRepository;

/**
 * Service.
 */
final class CategoriaReader
{
    private CategoriaRepository $repository;

    /**
     * The constructor.
     *
     * @param CategoriaRepository $repository The repository
     */
    public function __construct(CategoriaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a categoria.
     *
     * @param int $categoriaId The categoria id
     *
     * @return CategoriaReaderResult The result
     */
    public function getCategoria(int $categoriaId): CategoriaReaderResult
    {
        // Input validation
        // ...

        // Fetch data from the database
        $categoriaRow = $this->repository->getCategoriaById($categoriaId);

        // Optional: Add or invoke your complex business logic here
        // ...

        // Create domain result
        $result = new CategoriaReaderResult();
        $result->id = $categoriaRow['id'];
        $result->categoria = $categoriaRow['categoria'];
        $result->id_condicion = $categoriaRow['id_condicion'];
        $result->id_departamento = $categoriaRow['name'];
        $result->created = $categoriaRow['created'];
        $result->updated = $categoriaRow['updated'];

        return $result;
    }
}