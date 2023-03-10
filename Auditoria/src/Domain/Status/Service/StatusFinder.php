<?php

namespace App\Domain\Status\Service;

use App\Domain\Status\Data\StatusFinderItem;
use App\Domain\Status\Data\StatusFinderResult;
use App\Domain\Status\Repository\StatusFinderRepository;

final class StatusFinder
{
    private StatusFinderRepository $repository;

    public function __construct(StatusFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findStatus($tipo_status): StatusFinderResult
    {
        // Input validation
        // ...

        $status = $this->repository->findStatus($tipo_status);

        return $this->createResult($status);
    }

    private function createResult(array $statusRows): StatusFinderResult
    {
        $result = new StatusFinderResult();

        foreach ($statusRows as $statusRow) {
            $status = new StatusFinderItem();
            $status->id = $statusRow['id'];
            $status->status = $statusRow['status'];
            $status->status_number = $statusRow['status_number'];
            $status->grouping = $statusRow['grouping'];
            $status->condition = $statusRow['condition'];
            $status->created = $statusRow['created'];
            $status->updated = $statusRow['updated'];

            $result->status[] = $status;
        }

        return $result;
    }
}
