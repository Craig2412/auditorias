<?php

namespace App\Action\Estados;

use App\Domain\Estados\Service\EstadosDeleter;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class EstadosDeleterAction
{
    private EstadosDeleter $estadosDeleter;

    private JsonRenderer $renderer;

    public function __construct(EstadosDeleter $estadosDeleter, JsonRenderer $renderer)
    {
        $this->estadosDeleter = $estadosDeleter;
        $this->renderer = $renderer;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Fetch parameters from the request
        $estadosId = (int)$args['estados_id'];

        // Invoke the domain (service class)
        $this->estadosDeleter->deleteEstados($estadosId);

        // Render the json response
        return $this->renderer->json($response, 'Registro eliminado');
    }
}
