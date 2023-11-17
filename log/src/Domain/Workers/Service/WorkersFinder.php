<?php

namespace App\Domain\Workers\Service;

use App\Domain\Workers\Data\WorkersFinderItem;
use App\Domain\Workers\Data\WorkersFinderResult;
use App\Domain\Workers\Repository\WorkersFinderRepository;

final class WorkersFinder
{
    private WorkersFinderRepository $repository;

    public function __construct(WorkersFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findWorkers(): WorkersFinderResult
    {
        // Input validation
        // ...

        $workers = $this->repository->findWorkers();

        return $this->createResult($workers);
    }

    private function createResult(array $workersRows): WorkersFinderResult
    {
        $result = new WorkersFinderResult();

        foreach ($workersRows as $workersRow) {
            $workers = new WorkersFinderItem();
            $workers->id = $workersRow['id'];
            $workers->charge = $workersRow['charge'];
            $workers->name = $workersRow['name'];
            $workers->surname = $workersRow['surname'];
            $workers->status = $workersRow['status'];
            $workers->deparment = $workersRow['deparment'];
            $workers->created = $workersRow['created'];
            $workers->updated = $workersRow['updated'];

            $result->workers[] = $workers;
        }

        return $result;
    }
}
