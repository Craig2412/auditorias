<?php

namespace App\Action\Appointment;

use App\Domain\Appointment\Service\AppointmentsUpdater;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AppointmentUpdaterAction
{
    private AppointmentsUpdater $appointmentUpdater;

    private JsonRenderer $renderer;

    public function __construct(AppointmentsUpdater $appointmentUpdater, JsonRenderer $jsonRenderer)
    {
        $this->appointmentUpdater = $appointmentUpdater;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Extract the form data from the request body
        $appointmentId = (int)$args['id_appointment'];
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $new_date = $this->appointmentUpdater->updateAppointment($appointmentId, $data);

        // Build the HTTP response
        return $this->renderer->json($response,['datos nuevos' => $new_date]);
    }
}
