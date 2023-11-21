<?php

namespace App\Domain\Estados\Service;

use App\Domain\Estados\Repository\EstadosRepository;
use App\Factory\ConstraintFactory;
use DomainException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validation;

final class EstadosValidator
{
    private EstadosRepository $repository;

    public function __construct(EstadosRepository $repository)
    {
        $this->repository = $repository;
    }

    public function validateEstadosUpdate(int $estadosId, array $data): void
    {
        if (!$this->repository->existsEstadosId($estadosId)) {
            throw new DomainException(sprintf('Estados not found: %s', $estadosId));
        }

        $this->validateEstados($data);
    }

    public function validateEstados(array $data): void
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
                'estado' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(5, 30)
                    ]
                ),
                'id_agrupacion' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(1,2),
                        $constraint->positive()
                    ]
                )                
            ]
        );
    }
}
