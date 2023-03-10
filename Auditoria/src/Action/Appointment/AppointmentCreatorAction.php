<?php

namespace App\Action\Appointment;

use App\Domain\Appointment\Service\AppointmentCreator;
use App\Renderer\JsonRenderer;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AppointmentCreatorAction
{
    private JsonRenderer $renderer;

    private AppointmentCreator $appointmentsCreator;

    public function __construct(AppointmentCreator $appointmentsCreator, JsonRenderer $renderer)
    {
        $this->appointmentsCreator = $appointmentsCreator;
        $this->renderer = $renderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Extract the form data from the request body
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $appointmentsId = $this->appointmentsCreator->createAppointment($data);

        // Build the HTTP response
        return $this->renderer
            ->json($response, ['appointments_id' => $appointmentsId])
            ->withStatus(StatusCodeInterface::STATUS_CREATED);
    }
}
