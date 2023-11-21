<?php

namespace App\Domain\Charges\Service;

use App\Domain\Charges\Data\ChargesReaderResult;
use App\Domain\Charges\Repository\ChargesRepository;

/**
 * Service.
 */
final class ChargesReader
{
    private ChargesRepository $repository;

    /**
     * The constructor.
     *
     * @param ChargesRepository $repository The repository
     */
    public function __construct(ChargesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a charges.
     *
     * @param int $chargesId The charges id
     *
     * @return ChargesReaderResult The result
     */
    public function getCharges(int $chargesId): ChargesReaderResult
    {
        // Input validation
        // ...

        // Fetch data from the database
        $chargesRow = $this->repository->getChargesById($chargesId);

        // Optional: Add or invoke your complex business logic here
        // ...

        // Create domain result
        $result = new ChargesReaderResult();
        $result->id = $chargesRow['id'];
        $result->charge = $chargesRow['charge'];

        return $result;
    }
}
