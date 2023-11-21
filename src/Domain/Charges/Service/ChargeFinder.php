<?php

namespace App\Domain\Charges\Service;

use App\Domain\Charges\Data\ChargeFinderItem;
use App\Domain\Charges\Data\ChargeFinderResult;
use App\Domain\Charges\Repository\ChargeFinderRepository;

final class ChargeFinder
{
    private ChargeFinderRepository $repository;

    public function __construct(ChargeFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findCustomers(): ChargeFinderResult
    {
        // Input validation
        // ...

        $customers = $this->repository->findCustomers();

        return $this->createResult($customers);
    }

    private function createResult(array $customerRows): ChargeFinderResult
    {
        $result = new ChargeFinderResult();

        foreach ($customerRows as $customerRow) {
            $customer = new ChargeFinderItem();
            $customer->id = $customerRow['id'];
            $customer->charge = $customerRow['charge'];

            $result->charges[] = $customer;
        }

        return $result;
    }
}
