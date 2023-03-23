<?php

namespace App\Action\Solicitudes;

use App\Domain\Solicitudes\Data\SolicitudesConsultReaderResult;
use App\Domain\Solicitudes\Service\SolicitudesConsultReader;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SolicitudesConsultReaderAction
{
    private SolicitudesConsultReader $solicitudesConsultReader;

    private JsonRenderer $renderer;

    public function __construct(SolicitudesConsultReader $solicitudesConsultReader, JsonRenderer $jsonRenderer)
    {
        $this->solicitudesConsultReader = $solicitudesConsultReader;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Fetch parameters from the request
        $solicitudesConsultId = (int)$args['num_request'];

        // Invoke the domain and get the result
        $solicitudesConsult = $this->solicitudesConsultReader->getSolicitudesConsult($solicitudesConsultId);

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($solicitudesConsult));
    }

    private function transform(SolicitudesConsultReaderResult $solicitudesConsult): array
    {
        return [
            'nro_derecho' => $solicitudesConsult->nro_derecho,
            'solicitud' => $solicitudesConsult->solicitud,
            'nombre' => $solicitudesConsult->nombre,
            'estatus' => $solicitudesConsult->estatus
        ];
    }
}
