<?php

namespace App\Action\Solicitudes;

use App\Domain\Solicitudes\Data\SolicitudesUniqueReaderResult;
use App\Domain\Solicitudes\Service\SolicitudesUniqueReader;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SolicitudesUniqueReaderAction
{
    private SolicitudesUniqueReader $solicitudesUniqueReader;

    private JsonRenderer $renderer;

    public function __construct(SolicitudesUniqueReader $solicitudesUniqueReader, JsonRenderer $jsonRenderer)
    {
        $this->solicitudesUniqueReader = $solicitudesUniqueReader;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Fetch parameters from the request
        $solicitudesUniqueId = (int)$args['id_request'];

        // Invoke the domain and get the result
        $solicitudesUnique = $this->solicitudesUniqueReader->getSolicitudesUnique($solicitudesUniqueId);

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($solicitudesUnique));
    }

    private function transform(SolicitudesUniqueReaderResult $solicitudesUnique): array
    {
        return [
            'id' => $solicitudesUnique->id,
            'num_request' => $solicitudesUnique->num_request,
            'num_registry' => $solicitudesUnique->num_registry,
            'approach' => $solicitudesUnique->approach,
            'response' => $solicitudesUnique->response,
            'company' => $solicitudesUnique->company,
            'category' => $solicitudesUnique->category,
            'condition' => $solicitudesUnique->condition,
            'status' => $solicitudesUnique->status,
            'updated' => $solicitudesUnique->updated
        ];
    }
}
