<?php

namespace App\Domain\Companies\Repository;

use App\Factory\QueryFactory;
use DomainException;

final class CompaniesRepositoryUpdate
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

    public function updateCompanies(int $companiesId, array $companies): array
    {
        $row = $this->toRow($companies);
        $this->queryFactory->newUpdate('companies', $row)
            ->where(['id' => $companiesId])
            ->execute();
            return $row;
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
            'rif' => $companies['rif']
        ];
    }
}
