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
 
    //Usuarios
    $app->group(
        '/usuarios',
        function (RouteCollectorProxy $app) { 
            $app->post('/token', \App\Action\Users\UsersFinderAction::class);

            $app->get('/{id_usuario}', \App\Action\Usuario\UsuarioReaderAction::class);//completed
            $app->get('/{nro_pag}/{cant_registros}', \App\Action\Usuario\UsuarioFinderAction::class);//completed
            $app->post('', \App\Action\Usuario\UsuarioCreatorAction::class);//completed
            $app->put('/{usuario_id}', \App\Action\Usuario\UsuarioUpdaterAction::class);//completed
            $app->delete ('/{usuario_id}', \App\Action\Usuario\UsuarioDeleterAction::class);//completed
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
            $app->get('/byCalendario/{nro_pag}/{cant_registros}/{fecha_inicial}/{fecha_final}', \App\Action\Citas\CitaCalendarioFinderAction::class);//
            $app->get('/{id_cita}', \App\Action\Citas\CitaReaderAction::class);//completed
            $app->get('/{nro_pag}/{cant_registros}[/{params:.*}]', \App\Action\Citas\CitaFinderAction::class);////Paginador//completed
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
            $app->get('', \App\Action\Solicitudes\SolicitudesFinderAction::class);//completed    LISTA DE SOLICITUDES SIN DISCRIMINACION
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
            $app->get('/unique/{id_mensaje}', \App\Action\Mensaje\MensajeReaderAction::class);//completed
            $app->get('/{id_solicitud}/{nro_pag}/{cant_registros}', \App\Action\Mensaje\MensajeFinderAction::class);//completed
            $app->post('', \App\Action\Mensaje\MensajeCreatorAction::class);//completed
            $app->put('/{mensaje_id}', \App\Action\Mensaje\MensajeUpdaterAction::class);//completed
            $app->delete ('/{mensaje_id}', \App\Action\Mensaje\MensajeDeleterAction::class);//completed
        }
    );

   
    // Formato_Citas
    $app->group(
        '/formato_citas',
        function (RouteCollectorProxy $app) {
            $app->get('', \App\Action\Formato_Citas\Formato_CitasFinderAction::class);//completed
            $app->get('/{formato_citas_id}', \App\Action\Formato_Citas\Formato_CitasReaderAction::class);//completed
            $app->post('', \App\Action\Formato_Citas\Formato_CitasCreatorAction::class);//completed
            $app->put('/{formato_citas_id}', \App\Action\Formato_Citas\Formato_CitasUpdaterAction::class);//completed
            $app->delete('/{formato_citas_id}', \App\Action\Formato_Citas\Formato_CitasDeleterAction::class);//completed
        }
    );


    // Estados_Paises
    $app->group(
        '/estados_paises',
        function (RouteCollectorProxy $app) {
            $app->get('', \App\Action\Estados_Paises\Estados_PaisesFinderAction::class);//completed
            $app->get('/{estado_pais_id}', \App\Action\Estados_Paises\Estados_PaisesReaderAction::class);//completed
        }
    );

    // Paises
    $app->group(
        '/paises',
        function (RouteCollectorProxy $app) {
            $app->get('', \App\Action\Paises\PaisesFinderAction::class);//
            $app->get('/{pais_id}', \App\Action\Paises\PaisesReaderAction::class);//
        }
    );


    // Roles
    $app->group(
        '/tokenes',
        function (RouteCollectorProxy $app) {
            $app->get('', \App\Action\Roles\RolesFinderAction::class);//
            $app->get('/{token_id}', \App\Action\Roles\RolesReaderAction::class);//
            $app->post('', \App\Action\Roles\RolesCreatorAction::class);//
            $app->put('/{token_id}', \App\Action\Roles\RolesUpdaterAction::class);//
            $app->delete('/{token_id}', \App\Action\Roles\RolesDeleterAction::class);//
        }
    );

    // Tokens
    $app->group(
        '/tokens',
        function (RouteCollectorProxy $app) {
            $app->get('', \App\Action\Tokens\TokensFinderAction::class);//
            $app->get('/{token_id}', \App\Action\Tokens\TokensReaderAction::class);//
            $app->post('', \App\Action\Tokens\TokensCreatorAction::class);//
            $app->put('/{token_id}', \App\Action\Tokens\TokensUpdaterAction::class);//
            $app->delete('/{token_id}', \App\Action\Tokens\TokensDeleterAction::class);//
        }
    );

    // EstatusCategoria
    $app->group(
        '/estatusCategoria',
        function (RouteCollectorProxy $app) {
            $app->get('', \App\Action\EstatusCategoria\EstatusCategoriaFinderAction::class);//
            $app->get('/{estatus_id}', \App\Action\EstatusCategoria\EstatusCategoriaReaderAction::class);//
        }
    );

    
    //AREAS
    $app->group(
        '/areas',
        function (RouteCollectorProxy $app) { 
            $app->get('', \App\Action\Areas\AreasFinderAction::class);//
            $app->get('/{area_id}', \App\Action\Areas\AreasReaderAction::class);//
            $app->post('', \App\Action\Areas\AreasCreatorAction::class);//
            $app->put('/{area_id}', \App\Action\Areas\AreasUpdaterAction::class);//
            $app->delete ('/{area_id}', \App\Action\Areas\AreasDeleterAction::class);//
        }
    );
         
};
