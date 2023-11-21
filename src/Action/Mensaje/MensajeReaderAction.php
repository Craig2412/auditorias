<?php

namespace App\Action\Mensaje;

use App\Domain\Mensaje\Data\MensajeReaderResult;
use App\Domain\Mensaje\Service\MensajeReader;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class MensajeReaderAction
{
    private MensajeReader $mensajeReader;

    private JsonRenderer $renderer;

    public function __construct(MensajeReader $mensajeReader, JsonRenderer $jsonRenderer)
    {
        $this->mensajeReader = $mensajeReader;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Fetch parameters from the request
        $mensajeId = (int)$args['id_mensaje'];

        // Invoke the domain and get the result
        $mensaje = $this->mensajeReader->getMensaje($mensajeId);

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($mensaje));
    }

    private function transform(MensajeReaderResult $mensaje): array
    {
        return [
            'id' => $mensaje->id,
            'mensaje' => $mensaje->mensaje,
            'id_usuario' => $mensaje->id_usuario,
            'nombre' => $mensaje->nombre,
            'id_solicitud' => $mensaje->id_solicitud,
            'titulo' => $mensaje->titulo,
            'created' => $mensaje->created,
            'updated' => $mensaje->updated
        ];
    }
}