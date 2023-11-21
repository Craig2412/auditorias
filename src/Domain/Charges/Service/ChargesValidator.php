<?php

namespace App\Domain\Charges\Service;

use App\Domain\Charges\Repository\ChargesRepository;
use App\Factory\ConstraintFactory;
use DomainException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validation;

final class ChargesValidator
{
    private ChargesRepository $repository;

    public function __construct(ChargesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function validateChargesUpdate(int $chargesId, array $data): void
    {
        if (!$this->repository->existsChargesId($chargesId)) {
            throw new DomainException(sprintf('Charges not found: %s', $chargesId));
        }

        $this->validateCharges($data);
    }

    public function validateCharges(array $data): void
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
                'charges' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(null, 10),
                        $constraint->positive(),
                    ]
                
                ),
            ]
        );
    }
}
