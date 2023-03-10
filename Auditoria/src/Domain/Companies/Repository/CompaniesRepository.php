<?php

namespace App\Domain\Companies\Repository;

use App\Factory\QueryFactory;
use DomainException;

final class CompaniesRepository
{
    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function insertCompanies(array $companies): int
    {
        return (int)$this->queryFactory->newInsert('companies', $this->toRow($companies))
            ->execute()
            ->lastInsertId();
    }

    public function getCompaniesById(int $companiesId): array
    {
        $query = $this->queryFactory->newSelect('companies');
        $query->select(
            [
                'id',
                'name',
                'rif',
                'signature'
            ]
        );

        $query->where(['id' => $companiesId]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('Companies not found: %s', $companiesId));
        }

        return $row;
    }

    public function updateCompanies(int $companiesId, array $companies): void
    {
        $row = $this->toRow($companies);

        $this->queryFactory->newUpdate('companies', $row)
            ->where(['id' => $companiesId])
            ->execute();
    }

    public function existsCompaniesId(int $companiesId): bool
    {
        $query = $this->queryFactory->newSelect('companies');
        $query->select('id')->where(['id' => $companiesId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    public function deleteCompaniesById(int $companiesId): void
    {
        $this->queryFactory->newDelete('companies')
            ->where(['id' => $companiesId])
            ->execute();
    }

    private function toRow(array $companies): array
    {
        return [
            'name' => $companies['name'],
            'rif' => $companies['rif'],
            'signature' => $companies['signature']
        ];
    }
}
