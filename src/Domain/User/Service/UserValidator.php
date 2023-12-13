<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;
use App\Factory\ConstraintFactory;
use DomainException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validation;

final class UserValidator
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function validateUserUpdate(int $userId, array $data): void
    {
        if (!$this->repository->existsCustomerId($userId)) {
            throw new DomainException(sprintf('Customer not found: %s', $userId));
        }

        $this->validateUser($data);
    }

    public function validateUser(array $data): void
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
    
                'nombre' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(null, 100),
                    ]
                ),
                'apellido' => $constraint->optional(
                    [
                        $constraint->notBlank(),
                        $constraint->length(null, 100),
                        $constraint->positive(),
                    ]
                ),
                'correo' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->email(),
                        $constraint->length(null, 100),
                    ]
                ),
                'telefono' => $constraint->optional(
                    [
                        $constraint->notBlank(),
                        $constraint->length(null, 11),
                    ]
                ),
                'id_rol' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->positive()
                    ]
                    ),
                'identificacion' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(null, 10),
                    ]
                    ),
                'clave' => $constraint->required(
                    [
                        $constraint->notBlank()
                        
                    ]
                )
            ]
        );
    }
}
