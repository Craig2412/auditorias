<?php

namespace App\Action\Usuario;

use App\Domain\Usuario\Data\UsuarioFinderResult;
use App\Domain\Usuario\Service\UsuarioFinder;
use App\Renderer\JsonRenderer;
use App\Action\argValidator;//Paginador
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


final class UsuarioFinderAction
{
    private UsuarioFinder $usuariosFinder;

    private JsonRenderer $renderer;

    public function __construct(UsuarioFinder $usuariosFinder, JsonRenderer $jsonRenderer)
    {
        $this->usuariosFinder = $usuariosFinder;
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

       
        $usuarios = $this->usuariosFinder->findUsuario($nro_pag,$parametros,$cant_registros);
    //Fin Paginador

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($usuarios));
    }

    public function transform(UsuarioFinderResult $result): array
    {
        $usuarios = [];

        foreach ($result->usuario as $usuario) {
            $usuarios[] = [
                'id' => $usuario->id,
                'nombre' => $usuario->nombre,
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

        return [
            'usuarios' => $usuarios,
        ];
    }
}

/*

En el código que analizamos anteriormente, la variable $args debe tener un parámetro llamado 'params' que contenga un valor específico. Este valor debe ser una cadena de texto en formato JSON. Por lo tanto, para enviar el valor adecuado en la variable $args['params'], debes asegurarte de que sea una cadena de texto en formato JSON válido. 
 
Aquí tienes un ejemplo de cómo podrías enviar el valor en la variable $args['params']: 
 
$args['params'] = '{"format_appointment": "some_value", "name": "some_name", "surname": "some_surname"}'; 
 
En este ejemplo, se utiliza un objeto JSON con las claves 'format_appointment', 'name' y 'surname', y se les asignan algunos valores. Puedes ajustar los valores y las claves según tus necesidades. 
 
Recuerda que este es solo un ejemplo y debes adaptarlo a tu caso específico, asegurándote de que el valor en la variable $args['params'] sea una cadena de texto en formato JSON válido.

*/