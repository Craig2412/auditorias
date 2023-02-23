<?php

namespace App\Action\Solicitudes;

use App\Domain\Solicitudes\Data\SolicitudesReaderResult;
use App\Domain\Solicitudes\Service\SolicitudesReader;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SolicitudesReaderAction
{
    private SolicitudesReader $solicitudesReader;

    private JsonRenderer $renderer;

    public function __construct(SolicitudesReader $solicitudesReader, JsonRenderer $jsonRenderer)
    {
        $this->solicitudesReader = $solicitudesReader;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Fetch parameters from the request
        $solicitudesId = (int)$args['id_requirement'];

        // Invoke the domain and get the result
        $solicitudes = $this->solicitudesReader->getSolicitudes($solicitudesId);

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($solicitudes));
    }

    private function transform(SolicitudesReaderResult $result): array
    {
        $solicitudes = [];
//var_dump($result);
        foreach ($result->solicitudes as $solicitudes) {
            $solicitud[] = [
                'id' => $solicitudes->id,
                'num_request' => $solicitudes->num_request,
                'num_registry' => $solicitudes->num_registry,
                'approach' => $solicitudes->approach,
                'response' => $solicitudes->response,
                'company' => $solicitudes->company,
                'category' => $solicitudes->category,
                'condition' => $solicitudes->condition,
                'status' => $solicitudes->status,
                'updated' => $solicitudes->updated
            ];
        }

        return [
            'solicitudes' => array_reverse($solicitud),
        ];
    }
}

/*
$solicitudes = [];

        foreach ($result->solicitudes as $solicitudes) {
            $soolicitud[] = [
                'id' => $solicitud->id,
                'num_request' => $solicitud->num_request,
                'num_registry' => $solicitud->num_registry,
                'approach' => $solicitud->approach,
                'response' => $solicitud->response,
                'company' => $solicitud->company,
                'category' => $solicitud->category,
                'condition' => $solicitud->condition,
                'status' => $solicitud->status,
                'updated' => $solicitud->updated
            ];
        }

        return [
            'solicitudes' => $solicitudes,
        ];*/



        /*
         return [
            'id' => $solicitudes->id,
            'num_request' => $solicitudes->num_request,
            'num_registry' => $solicitudes->num_registry,
            'approach' => $solicitudes->approach,
            'response' => $solicitudes->response,
            'company' => $solicitudes->company,
            'category' => $solicitudes->category,
            'condition' => $solicitudes->condition,
            'status' => $solicitudes->status,
            'updated' => $solicitudes->updated
        ]; */