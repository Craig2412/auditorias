<?php

namespace App\Action\Requerimientos;

use App\Domain\Requerimientos\Data\RequerimientoslistaxEstadosFinderResult;
use App\Domain\Requerimientos\Service\RequerimientoslistaxEstadosFinder;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class RequerimientoslistaxEstadosFinderAction
{
    
    private RequerimientoslistaxEstadosFinder $requerimientoslistaxEstadosFinder;

    private JsonRenderer $renderer;

    public function __construct(RequerimientoslistaxEstadosFinder $requerimientoslistaxEstadosFinder, JsonRenderer $jsonRenderer)
    {

        $this->requerimientoslistaxEstadosFinder = $requerimientoslistaxEstadosFinder;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {

        $requerimientoslistaxEstados = $this->requerimientoslistaxEstadosFinder->findRequerimientoslistaxEstados();
  

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($requerimientoslistaxEstados));
    }

    public function transform(RequerimientoslistaxEstadosFinderResult $result): array
    {
        $requerimientos = [];

        foreach ($result->requerimientos as $requerimiento) {
            $requerimientos[] = [
                'id' => $requerimiento->id,
                'id_formato_cita' => $requerimiento->id_formato_cita,
                'formato_cita' => $requerimiento->formato_cita,
                'id_usuario' => $requerimiento->id_usuario,
                'nombre' => $requerimiento->nombre,
                'trabajador' => $requerimiento->trabajador,
                'apellido' => $requerimiento->apellido,
                'identificacion' => $requerimiento->identificacion,
                'id_pais' => $requerimiento->id_pais,
                'pais' => $requerimiento->pais,
                'id_estado_pais' => $requerimiento->id_estado_pais,
                'estado_pais' => $requerimiento->estado_pais,
                'id_condicion' => $requerimiento->id_condicion,
                'id_estado' => $requerimiento->id_estado,
                'estado' => $requerimiento->estado,
                'id_trabajador' => $requerimiento->id_trabajador,
                'created' => $requerimiento->created,
                'updated' => $requerimiento->updated
            ];
        }

        return [
            'requerimientoslistaxEstados' => $requerimientoslistaxEstados,
        ];
    }
}
/*


EJEMPLO DEL STRING QUE SE DEBE ENVIAR POR LOS PARAMETROS CON FORMATO JSON:
    {"area": "some_value", "status": "some_name", "type_requerimientoslistaxEstados": "some_surname"}
*/