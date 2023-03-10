<?php

namespace App\Domain\Categories\Service;

use App\Domain\Categories\Repository\CategoriesRepository;
use App\Factory\ConstraintFactory;
use DomainException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validation;

final class CategoriesValidatorUpdate
{
    private CategoriesRepository $repository;

    public function __construct(CategoriesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function validateCategoriesUpdate(int $categoriesId, array $data): void
    {
        if (!$this->repository->existsCategoriesId($categoriesId)) {
            throw new DomainException(sprintf('Categories not found: %s', $categoriesId));
        }

        $this->validateCategories($data);
    }

    public function validateCategories(array $data): void
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
                'category' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(null, 100),
                    ]
                ),
                'id_deparment' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(1,11),
                    ]
                )
            ]
        );
    }
}
