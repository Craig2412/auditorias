<?php

namespace App\Domain\Appointment\Service;

use App\Domain\Appointment\Repository\AppointmentRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

final class AppointmentCreator
{
    private AppointmentRepository $repository;

    private AppointmentValidator $appointmentValidator;

    private LoggerInterface $logger;

    public function __construct(
        AppointmentRepository $repository,
        AppointmentValidator $appointmentValidator,
        LoggerFactory $loggerFactory
    ) {
        $this->repository = $repository;
        $this->appointmentValidator = $appointmentValidator;
        $this->logger = $loggerFactory
            ->addFileHandler('appointment_creator.log')
            ->createLogger();
    }

    public function createAppointment(array $data): int
    {
        // Input validation
        $this->appointmentValidator->validateAppointment($data);

        // Insert appointment and get new appointment ID
        $appointmentId = $this->repository->insertAppointment($data);

        // Logging
        $this->logger->info(sprintf('Appointment created successfully: %s', $appointmentId));

        return $appointmentId;
    }
}
