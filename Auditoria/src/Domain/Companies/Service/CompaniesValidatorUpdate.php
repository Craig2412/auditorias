<?php

namespace App\Domain\Companies\Service;

use App\Domain\Companies\Repository\CompaniesRepository;
use App\Factory\ConstraintFactory;
use DomainException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validation;

final class CompaniesValidatorUpdate
{
    private CompaniesRepository $repository;

    public function __construct(CompaniesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function validateCompaniesUpdate(int $companiesId, array $data): void
    {
        if (!$this->repository->existsCompaniesId($companiesId)) {
            throw new DomainException(sprintf('Companies not found: %s', $companiesId));
        }

        $this->validateCompanies($data);
    }

    public function validateCompanies(array $data): void
    {
        $validator = Validation::createValidator();
        $violations = $validator->validate($data, $this->createConstraints());

        if ($violations->count()) {
            throw new ValidationFailedException('Please check your input', $violations);
        }
    }

    private function createConstraints(): Constraint
    {
        $constraint = new ConstraintFactory();

        return $constraint->collection(
            [
                'name' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(null, 100),
                    ]
                ),
                'rif' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(10),
                    ]
                )
            ]
        );
    }
}
