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
                'num_request' => $constraint->required(
                    [
                        $constraint->length(null, 10),
                        $constraint->positive()
                    ]
                
                ),
                'num_registry' => $constraint->required(
                    [
                        $constraint->length(null, 10),
                        $constraint->positive(),
                    ]
                
                ),
                'approach' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(null, 250),
                        $constraint->positive(),
                    ]
                
                ),
                'id_company_represented' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(null, 10),
                        $constraint->positive(),
                    ]
                
                ),
                'id_category' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(null, 10),
                        $constraint->positive(),
                    ]
                
                ),
                'id_requirement' => $constraint->required(
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
