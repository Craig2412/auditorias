<?php

namespace App\Action\Appointment;

use App\Domain\Appointment\Data\AppointmentReaderResult;
use App\Domain\Appointment\Service\AppointmentReader;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AppointmentReaderAction
{
    private AppointmentReader $appointmentReader;

    private JsonRenderer $renderer;

    public function __construct(AppointmentReader $appointmentReader, JsonRenderer $jsonRenderer)
    {
        $this->appointmentReader = $appointmentReader;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Fetch parameters from the request
        $appointmentId = (int)$args['id_appointment'];

        // Invoke the domain and get the result
        $appointment = $this->appointmentReader->getAppointment($appointmentId);

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($appointment));
    }

    private function transform(AppointmentReaderResult $appointment): array
    {
        return [
            'id' => $appointment->id,
            'appointment_date' => $appointment->appointment_date,
            'id_requirement' => $appointment->id_requirement,
            'status' => $appointment->status,
            'format_appointments' => $appointment->format_appointments,
            'created' => $appointment->created,
            'updated' => $appointment->updated            
        ];
    }
}
