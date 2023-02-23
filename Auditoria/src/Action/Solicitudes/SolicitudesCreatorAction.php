<?php

namespace App\Action\Solicitudes;

use App\Domain\Solicitudes\Service\SolicitudesCreator;
use App\Renderer\JsonRenderer;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SolicitudesCreatorAction
{
    private JsonRenderer $renderer;

    private SolicitudesCreator $solicitudesCreator;

    public function __construct(SolicitudesCreator $solicitudesCreator, JsonRenderer $renderer)
    {
        $this->solicitudesCreator = $solicitudesCreator;
        $this->renderer = $renderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Extract the form data from the request body
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $solicitudesId = $this->solicitudesCreator->createSolicitudes($data);

        // Build the HTTP response
        return $this->renderer
            ->json($response, ['id_solicitud' => $solicitudesId])
            ->withStatus(StatusCodeInterface::STATUS_CREATED);
    }
}
