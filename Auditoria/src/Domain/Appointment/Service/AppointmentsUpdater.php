<?php

namespace App\Domain\Appointment\Service;

use App\Domain\Appointment\Repository\AppointmentsRepositoryUpdate;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

final class AppointmentsUpdater
{
    private AppointmentsRepositoryUpdate $repositoryUpdate;

    private AppointmentsValidatorUpdate $appointmentValidatorUpdate;

    private LoggerInterface $logger;

    public function __construct(
        AppointmentsRepositoryUpdate $repositoryUpdate,
        AppointmentsValidatorUpdate $appointmentValidatorUpdate,
        LoggerFactory $loggerFactory
    ) {
        $this->repositoryUpdate = $repositoryUpdate;
        $this->appointmentValidatorUpdate = $appointmentValidatorUpdate;
        $this->logger = $loggerFactory
            ->addFileHandler('appointment_updater.log')
            ->createLogger();
    }

    public function updateAppointment(int $appointmentId, array $data): array
    {
        // Input validation
        $this->appointmentValidatorUpdate->validateAppointmentUpdate($appointmentId, $data);

        // Update the row
        $var = $this->repositoryUpdate->updateAppointment($appointmentId, $data);
        

        // Logging
        $this->logger->info(sprintf('Appointment updated successfully: %s', $appointmentId));

        return $var;
    }
}
