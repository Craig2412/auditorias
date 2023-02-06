<?php

namespace App\Domain\categorias\Service;

use App\Domain\categorias\Data\categoriasReaderResult;
use App\Domain\categorias\Repository\categoriasRepository;

/**
 * Service.
 */
final class categoriasReader
{
    private categoriasRepository $repository;

    /**
     * The constructor.
     *
     * @param categoriasRepository $repository The repository
     */
    public function __construct(categoriasRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a categorias.
     *
     * @param int $categoriasId The categorias id
     *
     * @return categoriasReaderResult The result
     */
    public function getcategorias(int $categoriasId): categoriasReaderResult
    {
        // Input validation
        // ...

        // Fetch data from the database
        $categoriasRow = $this->repository->getcategoriasById($categoriasId);

        // Optional: Add or invoke your complex business logic here
        // ...

        // Create domain result
        $result = new categoriasReaderResult();
        $result->id = $categoriasRow['id'];
        $result->number = $categoriasRow['number'];
        $result->name = $categoriasRow['name'];
        $result->street = $categoriasRow['street'];
        $result->postalCode = $categoriasRow['postal_code'];
        $result->city = $categoriasRow['city'];
        $result->country = $categoriasRow['country'];
        $result->email = $categoriasRow['email'];

        return $result;
    }
}
