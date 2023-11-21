<?php

// Define app routes
use Slim\App;
use Slim\Routing\RouteCollectorProxy;



return function (App $app) {
    // Redirect to Swagger documentation
    $app->get('/', \App\Action\Home\HomeAction::class)->setName('home');
    $app->get('/dashboard', \App\Action\Home\HomeAction::class)->setName('dashboard');
    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response;
    });


    //Auth
    $app->group(
        '/auth',
        function (RouteCollectorProxy $app) { 
            $app->post('/user/create', \App\Action\Auth\AuthSigninAction::class);
            $app->post('/user/authentication', \App\Action\Auth\AuthLoginAction::class);
        }
    );
 
    //User
    $app->group(
        '/usuario',
        function (RouteCollectorProxy $app) { 
            $app->post('/token', \App\Action\Users\UsersFinderAction::class);
        }
    );

    //Permisos
    $app->group(
        '/permisos',
        function (RouteCollectorProxy $app) { 
            $app->get('/{nro_pag}/{cant_registros}[/{params:.*}]', \App\Action\Permisos\PermisosFinderAction::class);
            $app->get('/{id_permisos}', \App\Action\Permisos\PermisosReaderAction::class);
            $app->post('', \App\Action\Permisos\PermisosCreatorAction::class);//
            $app->put('/{id_permisos}', \App\Action\Permisos\PermisosUpdaterAction::class);
            $app->delete ('/{id_permisos}', \App\Action\Permisos\PermisosDeleterAction::class);
        }
    );

    // Estados
    $app->group(
        '/estados',
        function (RouteCollectorProxy $app) {
            $app->get('', \App\Action\Estados\EstadosFinderAction::class);//completed
            $app->get('/{estados_id}', \App\Action\Estados\EstadosReaderAction::class);//completed
            $app->post('', \App\Action\Estados\EstadosCreatorAction::class);//completed
            $app->put('/{estados_id}', \App\Action\Estados\EstadosUpdaterAction::class);//completed
            $app->delete('/{estados_id}', \App\Action\Estados\EstadosDeleterAction::class);//completed
        }
    );

    //Citas
    $app->group(
        '/citas',
        function (RouteCollectorProxy $app) { 
            $app->get('/{nro_pag}/{cant_registros}[/{params:.*}]', \App\Action\Citas\CitaFinderAction::class);////Paginador//completed
            $app->get('/{id_cita}', \App\Action\Citas\CitaReaderAction::class);//completed
            $app->post('', \App\Action\Citas\CitaCreatorAction::class);//completed
            $app->put('/{id_cita}', \App\Action\Citas\CitaUpdaterAction::class);//completed
            $app->delete ('/{id_cita}', \App\Action\Citas\CitaDeleterAction::class);//completed
        }
    );

    //Bufetes
    $app->group(
        '/bufetes',
        function (RouteCollectorProxy $app) { 
            $app->get('', \App\Action\Bufete\BufeteFinderAction::class);//completed
            $app->get('/{id_bufete}', \App\Action\Bufete\BufeteReaderAction::class);//completed
            $app->post('', \App\Action\Bufete\BufeteCreatorAction::class);//completed
            $app->put('/{id_bufete}', \App\Action\Bufete\BufeteUpdaterAction::class);//completed
            $app->delete ('/{id_bufete}', \App\Action\Bufete\BufeteDeleterAction::class);//completed
        }
    );

    //SOLICITUDES 
    $app->group(
        '/solicitudes',
        function (RouteCollectorProxy $app) { 
            $app->get('', \App\Action\Solicitudes\SolicitudesFinderAction::class);//completed
            $app->get('/consulta/{nro_solicitud}', \App\Action\Solicitudes\SolicitudesConsultaReaderAction::class);//completed          //Se conecta con el sipi y devuelve los datos de un numero de solicitud
            $app->get('/{id_requerimiento}', \App\Action\Solicitudes\SolicitudesReaderAction::class);//completed           //ESTA TRAE LAS SOLICITUDES DE UN REQUERIMIENTO
            $app->get('/unicas/{id_solicitud}', \App\Action\Solicitudes\SolicitudesUnicasReaderAction::class);//completed        //ESTA TRAE LA SOLICITUD UNICA DE UN REQUERIMIENTO
            $app->post('', \App\Action\Solicitudes\SolicitudesCreatorAction::class);//completed
            $app->put('/{id_solicitud}', \App\Action\Solicitudes\SolicitudesUpdaterAction::class);//completed
            $app->delete ('/{id_solicitud}', \App\Action\Solicitudes\SolicitudesDeleterAction::class);
        }
    );

    //REQUERIMIENTO
    $app->group(
        '/requerimientos',
        function (RouteCollectorProxy $app) { 
            $app->get('/unique/{id_requerimiento}', \App\Action\Requerimientos\RequerimientosReaderAction::class);//completed
            $app->get('/{nro_pag}/{cant_registros}[/{params:.*}]', \App\Action\Requerimientos\RequerimientosFinderAction::class);//completed
            $app->post('', \App\Action\Requerimientos\RequerimientosCreatorAction::class);//completed
            $app->put('/{id_requerimiento}', \App\Action\Requerimientos\RequerimientosUpdaterAction::class);//completed
            $app->delete ('/{id_requerimiento}', \App\Action\Requerimientos\RequerimientosDeleterAction::class);//completed
        }
    );

    //CATEGORIAS
    $app->group(
        '/categorias',
        function (RouteCollectorProxy $app) { 
            $app->get('', \App\Action\Categorias\CategoriasFinderAction::class);//completed
            $app->get('/{categoria_id}', \App\Action\Categorias\CategoriasReaderAction::class);//completed
            $app->post('', \App\Action\Categorias\CategoriasCreatorAction::class);//completed
            $app->put('/{categoria_id}', \App\Action\Categorias\CategoriasUpdaterAction::class);//completed
            $app->delete ('/{categoria_id}', \App\Action\Categorias\CategoriasDeleterAction::class);//completed
        }
    );

    
   //Mensajes
   $app->group(
    '/mensajes',
    function (RouteCollectorProxy $app) { 
        $app->get('/unique/{id_mensaje}', \App\Action\Mensaje\MensajeReaderAction::class);//
        $app->get('/{id_solicitud}/{nro_pag}/{cant_registros}', \App\Action\Mensaje\MensajeFinderAction::class);//
        $app->post('', \App\Action\Mensaje\MensajeCreatorAction::class);//
        $app->put('/{mensaje_id}', \App\Action\Mensaje\MensajeUpdaterAction::class);//
        $app->delete ('/{mensaje_id}', \App\Action\Mensaje\MensajeDeleterAction::class);//
    }
);

   // API
    $app->group(
        '/api',
        function (RouteCollectorProxy $app) {
           
            $app->get('/customers', \App\Action\Customer\CustomerFinderAction::class);//test
            $app->get('/customers/{customer_id}', \App\Action\Customer\CustomerReaderAction::class);//test
            $app->post('/customers', \App\Action\Customer\CustomerCreatorAction::class);//test
            $app->put('/customers/{customer_id}', \App\Action\Customer\CustomerUpdaterAction::class);//test
            $app->delete('/customers/{customer_id}', \App\Action\Customer\CustomerDeleterAction::class);//test
        }
    );
};
