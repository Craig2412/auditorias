<?php

namespace App\Domain\Solicitudes\Service;

use App\Domain\Solicitudes\Repository\SolicitudesRepository;
use App\Factory\ConstraintFactory;
use DomainException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validation;

final class SolicitudesValidator
{
    private SolicitudesRepository $repository;

    public function __construct(SolicitudesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function validateSolicitudesUpdate(int $solicitudesId, array $data): void
    {
        if (!$this->repository->existsSolicitudesId($solicitudesId)) {
            throw new DomainException(sprintf('Solicitudes not found: %s', $solicitudesId));
        }

        $this->validateSolicitudes($data);
    }

    public function validateSolicitudes(array $data): void
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
                'num_solicitud' => $constraint->required(
                    [
                        $constraint->length(10, 10),
                        $constraint->positive()
                    ]                
                ),
                'num_registro' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(7, 7),
                        $constraint->positive()
                    ]
                ),
                'id_requerimiento' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(1, 10),
                        $constraint->positive()
                    ]
                ),
                'id_categoria' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(1, 10),
                        $constraint->positive()
                    ]
                ),
                'descripcion' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(null, 500),
                    ]
                )
            ]
        );
    }
}
