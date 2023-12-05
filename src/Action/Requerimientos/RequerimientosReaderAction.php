<?php

namespace App\Action\Requerimientos;

use App\Domain\Requerimientos\Data\RequerimientosReaderResult;
use App\Domain\Requerimientos\Service\RequerimientosReader;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class RequerimientosReaderAction
{
    private RequerimientosReader $requerimientoReader;

    private JsonRenderer $renderer;

    public function __construct(RequerimientosReader $requerimientoReader, JsonRenderer $jsonRenderer)
    {
        $this->requerimientoReader = $requerimientoReader;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        // Fetch parameters from the request
        $requerimientoId = (int)$args['id_requerimiento'];

        // Invoke the domain and get the result
        $requerimiento = $this->requerimientoReader->getRequerimientos($requerimientoId);

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($requerimiento));
    }

    private function transform(RequerimientosReaderResult $requerimiento): array
    {
        return [
            
            'id' => $requerimiento->id,
            'id_formato_cita' => $requerimiento->id_formato_cita,
            'formato_cita' => $requerimiento->formato_cita,
            'id_usuario' => $requerimiento->id_usuario,
            'nombre' => $requerimiento->nombre,
            'trabajador' => $requerimiento->trabajador,
            'apellido' => $requerimiento->apellido,
            'identificacion' => $requerimiento->identificacion,
            'id_pais' => $requerimiento->id_pais,
            'id_estado_pais' => $requerimiento->id_estado_pais,
            'pais' => $requerimiento->pais,
            'estado_pais' => $requerimiento->estado_pais,
            'id_condicion' => $requerimiento->id_condicion,
            'id_estado' => $requerimiento->id_estado,
            'estado' => $requerimiento->estado,
            'id_trabajador' => $requerimiento->id_trabajador,
            'created' => $requerimiento->created,
            'updated' => $requerimiento->updated
            
        ];
    }
}
