<?php

namespace App\Action\Requerimientos;

use App\Domain\Requerimientos\Data\RequerimientosFinderResult;
use App\Domain\Requerimientos\Service\RequerimientosFinder;
use App\Renderer\JsonRenderer;
use App\Action\argValidator;//Paginador
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


final class RequerimientosFinderAction
{
    private RequerimientosFinder $requerimientosFinder;

    private JsonRenderer $renderer;

    public function __construct(RequerimientosFinder $requerimientosFinder, JsonRenderer $jsonRenderer)
    {
        $this->requerimientosFinder = $requerimientosFinder;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

    //Paginador
        if (isset($args['nro_pag']) && ($args['nro_pag'] > 0)) {
            $nro_pag = (int)$args['nro_pag'];
        }else {
            $nro_pag = 1;
        }

        if (isset($args['cant_registros']) && ($args['cant_registros'] > 0)) {
            $cant_registros = $args['cant_registros'];
        }else {
            $cant_registros = 10;
        }

        if (isset($args['params'])) {
            $clase_busqueda = New argValidator;
            $params = explode('/', $args['params']);
            $params = json_decode($params[0]);          
            $parametros = $clase_busqueda->whereGenerate($params,'appointments');          
        }else {
            $parametros = null;
        }

        $requerimientos = $this->requerimientosFinder->findRequerimientos($nro_pag,$parametros,$cant_registros);
    //Fin Paginador
    //$nro_pag,$parametros,$cant_registros


        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($requerimientos));
    }

    public function transform(RequerimientosFinderResult $result): array
    {
        $requerimientos = [];

        foreach ($result->requerimientos as $requerimiento) {
            $requerimientos[] = [
                'id' => $requerimiento->id,
                'id_formato_cita' => $requerimiento->id_formato_cita,
                'formato_cita' => $requerimiento->formato_cita,
                'id_usuario' => $requerimiento->id_usuario,
                'nombre' => $requerimiento->nombre,
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
            'requerimientos' => $requerimientos,
        ];
    }
}
