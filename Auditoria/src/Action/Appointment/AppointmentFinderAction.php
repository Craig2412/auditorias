<?php

namespace App\Action\Appointment;

use App\Domain\Appointment\Data\AppointmentFinderResult;
use App\Domain\Appointment\Service\AppointmentFinder;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AppointmentFinderAction
{
    private AppointmentFinder $appointmentFinder;

    private JsonRenderer $renderer;

    public function __construct(AppointmentFinder $appointmentFinder, JsonRenderer $jsonRenderer)
    {
        $this->appointmentFinder = $appointmentFinder;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Optional: Pass parameters from the request to the service method
        // ...

        $appointments = $this->appointmentFinder->findAppointment();

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($appointments));
    }

    public function transform(AppointmentFinderResult $result): array
    {
        $appointments = [];

        foreach ($result->appointment as $appointment) {
            $appointments[] = [
                'id' => $appointment->id,
                'appointment_date' => $appointment->appointment_date,
                'id_requirement' => $appointment->id_requirement,
                'status' => $appointment->status,
                'format_appointment' => $appointment->format_appointment,
                'updated' => $appointment->updated,
                'created' => $appointment->created
            ];
        }

        return [
            'appointments' => $appointments,
        ];
    }
}
