<?php

namespace App\Action\Appointment;

use App\Domain\Appointment\Data\AppointmentFinderResult;
use App\Domain\Appointment\Service\AppointmentFinder;
use App\Renderer\JsonRenderer;
use App\Action\argValidator;//Paginador
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AppointmentFinderAction
{
    private AppointmentFinder $appointmentFinder;

    private JsonRenderer $renderer;

    public function __construct(AppointmentFinder $appointmentFinder, JsonRenderer $jsonRenderer)
    {
        $this->appointmentFinder = $appointmentFinder;
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

        $appointments = $this->appointmentFinder->findAppointment($nro_pag,$parametros,$cant_registros);
    //Fin Paginador
    //$nro_pag,$parametros,$cant_registros

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($appointments));
    }

    public function transform(AppointmentFinderResult $result): array
    {
        $appointments = [];
        if (isset($result->appointment)) {
            foreach ($result->appointment as $appointment) {
                $appointments[] = [
                    'id' => $appointment->id,
                    'appointment_date' => $appointment->appointment_date,
                    'id_requirement' => $appointment->id_requirement,
                    'status' => $appointment->status,
                    'format_appointment' => $appointment->format_appointment,
                    'updated' => $appointment->updated,
                    'created' => $appointment->created
                ];
            }
        }        

        return [
            'appointments' => $appointments,
        ];
    }
}
