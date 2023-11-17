<?php

namespace App\Action\Bufete;

use App\Domain\Bufete\Data\BufeteFinderResult;
use App\Domain\Bufete\Service\BufeteFinder;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class BufeteFinderAction
{
    private BufeteFinder $bufeteFinder;

    private JsonRenderer $renderer;

    public function __construct(BufeteFinder $bufeteFinder, JsonRenderer $jsonRenderer)
    {
        $this->bufeteFinder = $bufeteFinder;
        $this->renderer = $jsonRenderer;

    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Optional: Pass parameters from the request to the service method
        // ...

        $bufetes = $this->bufeteFinder->findBufete();

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($bufetes));
    }

    public function transform(BufeteFinderResult $result): array
    {
        $bufetes = [];

        foreach ($result->bufetes as $bufete) {
            $bufetes[] = [
                'id' => $bufete->id,
                'nombre_bufete' => $bufete->nombre_bufete,
                'rif' => $bufete->rif,
                'correo_bufete' => $bufete->correo,
                'telefono_bufete' => $bufete->telefono,
                'id_usuario' => $bufete->id_usuario,
                'nombre' => $bufete->nombre,
                'apellido' => $bufete->apellido,
                'identificacion' => $bufete->identificacion,
                'id_condicion' => $bufete->id_condicion,
                'created' => $bufete->created,
                'updated' => $bufete->updated
            ];
        }
        return [
            'bufetes' => $bufetes,
        ];
    }
}
