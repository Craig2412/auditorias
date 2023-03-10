<?php

namespace App\Domain\Appointment\Service;

use App\Domain\Appointment\Repository\AppointmentRepository;
use App\Factory\ConstraintFactory;
use DomainException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validation;

final class AppointmentValidator
{
    private AppointmentRepository $repository;

    public function __construct(AppointmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function validateAppointmentUpdate(int $appointmentId, array $data): void
    {
        if (!$this->repository->existsAppointmentId($appointmentId)) {
            throw new DomainException(sprintf('Appointment not found: %s', $appointmentId));
        }

        $this->validateAppointment($data);
    }

    public function validateAppointment(array $data): void
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
                'appointment_date' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(10),
                    ]
                ),
                'id_requirement' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(null, 25),
                    ]
                ),
                'id_status' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(1, 1),
                    ]
                ),
                'id_format_appointments' => $constraint->required(
                    [
                        $constraint->notBlank(),
                        $constraint->length(1, 1),
                    ]
                )
            ]
        );
    }
}
