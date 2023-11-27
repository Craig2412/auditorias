<?php

namespace App\Action\Formato_Citas;

use App\Domain\Formato_Citas\Data\Formato_CitasReaderResult;
use App\Domain\Formato_Citas\Service\Formato_CitasReader;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class Formato_CitasReaderAction
{
    private Formato_CitasReader $formato_citasReader;

    private JsonRenderer $renderer;

    public function __construct(Formato_CitasReader $formato_citasReader, JsonRenderer $jsonRenderer)
    {
        $this->formato_citasReader = $formato_citasReader;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Fetch parameters from the request
        $formato_citasId = (int)$args['formato_citas_id'];

        // Invoke the domain and get the result
        $formato_citas = $this->formato_citasReader->getFormato_Citas($formato_citasId);

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($formato_citas));
    }

    private function transform(Formato_CitasReaderResult $formato_citas): array
    {
        return [
            'id' => $formato_citas->id,
            'formato_cita' => $formato_citas->formato_cita           
        ];
    }
}
