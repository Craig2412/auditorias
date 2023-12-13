<?php

namespace App\Action\Usuario;

use App\Domain\Usuario\Data\UsuarioReaderResult;
use App\Domain\Usuario\Service\UsuarioReader;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UsuarioReaderAction
{
    private UsuarioReader $usuarioReader;

    private JsonRenderer $renderer;

    public function __construct(UsuarioReader $usuarioReader, JsonRenderer $jsonRenderer)
    {
        $this->usuarioReader = $usuarioReader;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Fetch parameters from the request
        $usuarioId = (int)$args['id_usuario'];

        // Invoke the domain and get the result
        $usuario = $this->usuarioReader->getUsuario($usuarioId);

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($usuario));
    }

    private function transform(UsuarioReaderResult $usuario): array
    {
        return [
            'id' => $usuario->id,
            'nombre' => $nombre->nombre ,
            'apellido' => $usuario->apellido,
            'correo' => $usuario->correo,
            'identificacion' => $usuario->identificacion,
            'telefono' => $usuario->telefono,
            'id_rol' => $usuario->id_rol,
            'rol' => $usuario->rol,
            'id_condicion' => $usuario->id_condicion,
            'created' => $usuario->created,
            'updated' => $usuario->updated
        ];
    }
}