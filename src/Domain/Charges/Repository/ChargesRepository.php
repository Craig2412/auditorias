<?php

namespace App\Domain\Charges\Repository;

use App\Factory\QueryFactory;
use DomainException;

final class ChargesRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function insertCharges(array $charges): int
    {
        return (int)$this->queryFactory->newInsert('charges', $this->toRow($charges))
            ->execute()
            ->lastInsertId();
    }

    public function getChargesById(int $chargesId): array
    {
        $query = $this->queryFactory->newSelect('charges');
        $query->select(
            [
                'id',
                'charge'
            ]
        );

        $query->where(['id' => $chargesId]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('Charges not found: %s', $chargesId));
        }

        return $row;
    }

    public function updateCharges(int $chargesId, array $charges): void
    {
        $row = $this->toRow($charges);

        $this->queryFactory->newUpdate('charges', $row)
            ->where(['id' => $chargesId])
            ->execute();
    }

    public function existsChargesId(int $chargesId): bool
    {
        $query = $this->queryFactory->newSelect('charges');
        $query->select('id')->where(['id' => $chargesId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    public function deleteChargesById(int $chargesId): void
    {
        $this->queryFactory->newDelete('charges')
            ->where(['id' => $chargesId])
            ->execute();
    }

    private function toRow(array $charges): array
    {
        return [
            'charge' => $charges['charges']
        ];
    }
}
