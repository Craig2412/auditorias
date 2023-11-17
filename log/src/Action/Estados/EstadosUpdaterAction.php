<?php

namespace App\Action\Estados;

use App\Domain\Estados\Service\EstadosUpdater;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class EstadosUpdaterAction
{
    private EstadosUpdater $estadosUpdater;

    private JsonRenderer $renderer;

    public function __construct(EstadosUpdater $estadosUpdater, JsonRenderer $jsonRenderer)
    {
        $this->estadosUpdater = $estadosUpdater;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Extract the form data from the request body
        $estadosId = (int)$args['estados_id'];
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $new_data = $this->estadosUpdater->updateEstados($estadosId, $data);

        // Build the HTTP response
        return $this->renderer->json($response,['Datos nuevos' => $new_data]);
    }
}
