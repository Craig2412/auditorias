<?php

namespace App\Action\Solicitudes;

use App\Domain\Solicitudes\Data\SolicitudesFinderResult;
use App\Domain\Solicitudes\Service\SolicitudesFinder;
use App\Action\conexionSipi;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SolicitudesFinderAction
{
    private SolicitudesFinder $solicitudFinder;

    private JsonRenderer $renderer;

    public function __construct(SolicitudesFinder $solicitudFinder, JsonRenderer $jsonRenderer)
    {
        $this->solicitudFinder = $solicitudFinder;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
                
        $solicitudes = $this->solicitudFinder->findSolicitudes();

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($solicitudes));
    }

    public function transform(SolicitudesFinderResult $result): array
    {
        $solicitudes = [];

        foreach ($result->solicitudes as $solicitud) {
            $solicitudes[] = [
                'id' => $solicitud->id,
                'num_request' => $solicitud->num_request,
                'num_registry' => $solicitud->num_registry,
                'approach' => $solicitud->approach,
                'response' => $solicitud->response,
                'company' => $solicitud->company,
                'condition' => $solicitud->condition,
                'status' => $solicitud->status,
                'updated' => $solicitud->updated
            ];
        }

        return [
            'solicitudes' => $solicitudes,
        ];
    }
}
