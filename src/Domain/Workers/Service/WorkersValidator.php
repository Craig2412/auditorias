<?php

namespace App\Domain\Workers\Service;

use App\Domain\Workers\Repository\WorkersRepository;
use App\Factory\ConstraintFactory;
use DomainException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validation;

final class WorkersValidator
{
    private WorkersRepository $repository;

    public function __construct(WorkersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function validateWorkersUpdate(int $workerId, array $data): void
    {
        if (!$this->repository->existsWorkersId($workerId)) {
            throw new DomainException(sprintf('Workers not found: %s', $workerId));
        }

        $this->validateWorkers($data);
    }

    public function validateWorkers(array $data): void
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
                'id_user' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(null, 10),
                        $constraint->positive(),
                    ]
                
                ),
                'id_status' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(null, 10),
                        $constraint->positive(),
                    ]
                
                ),
                'id_deparment' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(null, 10),
                        $constraint->positive(),
                    ]
                
                    ),
                'id_charge' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(null, 10),
                        $constraint->positive(),
                    ]
                
                )
            ]
        );
    }
}
