<?php

namespace App\Domain\Workers\Service;

use App\Domain\Workers\Data\WorkersReaderResult;
use App\Domain\Workers\Repository\WorkersRepository;

/**
 * Service.
 */
final class WorkersReader
{
    private WorkersRepository $repository;

    /**
     * The constructor.
     *
     * @param WorkersRepository $repository The repository
     */
    public function __construct(WorkersRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a workers.
     *
     * @param int $workersId The workers id
     *
     * @return WorkersReaderResult The result
     */
    public function getWorkers(int $workersId): WorkersReaderResult
    {
        $workersRow = $this->repository->getWorkersById($workersId);

        // Optional: Add or invoke your complex business logic here
        // ...

        // Create domain result
        $result = new WorkersReaderResult();
            $result->id = $workersRow['id'];
            $result->charge = $workersRow['charge'];
            $result->name = $workersRow['name'];
            $result->surname = $workersRow['surname'];
            $result->status = $workersRow['status'];
            $result->deparment = $workersRow['deparment'];
            $result->created = $workersRow['created'];
            $result->updated = $workersRow['updated'];

        return $result;
    }
}
