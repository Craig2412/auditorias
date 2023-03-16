<?php

// Define app routes
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    // Redirect to Swagger documentation
    $app->get('/', \App\Action\Home\HomeAction::class)->setName('home');
    $app->get('/dashboard', \App\Action\Home\HomeAction::class)->setName('dashboard');


    //Permission
    $app->group(
        '/permissions',
        function (RouteCollectorProxy $app) { 
            $app->get('/{nro_pag}/{cant_registros}[/{params:.*}]', \App\Action\Permissions\PermissionFinderAction::class);
            $app->get('/{id_permission}', \App\Action\Permissions\PermissionReaderAction::class);
            $app->post('', \App\Action\Permissions\PermissionCreatorAction::class);//Completado
            $app->put('/{id_permission}', \App\Action\Permissions\PermissionUpdaterAction::class);
            $app->delete ('/{id_permission}', \App\Action\Permissions\PermissionDeleterAction::class);
        }
    );

    //Status
    $app->group(
        '/status',
        function (RouteCollectorProxy $app) { 
            $app->get('/{tipo_status}', \App\Action\Status\StatusFinderAction::class);//Completado
            $app->post('', \App\Action\Status\StatusCreatorAction::class);//Completado
        }
    );

    //Appointment
    $app->group(
        '/appointments',
        function (RouteCollectorProxy $app) { 
            $app->get('/{nro_pag}/{cant_registros}[/{params:.*}]', \App\Action\Appointment\AppointmentFinderAction::class);//Completado//Paginador
            $app->get('/{id_appointment}', \App\Action\Appointment\AppointmentReaderAction::class);//Completado
            $app->post('', \App\Action\Appointment\AppointmentCreatorAction::class);//Completado
            $app->put('/{id_appointment}', \App\Action\Appointment\AppointmentUpdaterAction::class);//Completadoo
            $app->delete ('/{id_appointment}', \App\Action\Appointment\AppointmentDeleterAction::class);
        }
    );

    //Companies
    $app->group(
        '/companies',
        function (RouteCollectorProxy $app) { 
            $app->get('', \App\Action\Companies\CompaniesFinderAction::class);//Completado
            $app->get('/{id_company}', \App\Action\Companies\CompaniesReaderAction::class);//Completado
            $app->post('', \App\Action\Companies\CompaniesCreatorAction::class);//Completado
            $app->put('/{id_company}', \App\Action\Companies\CompaniesUpdaterAction::class);//Completado
            $app->delete ('/{id_company}', \App\Action\Companies\CompaniesDeleterAction::class);
        }
    );

    //REQUEST 
    $app->group(
        '/requests',
        function (RouteCollectorProxy $app) { 
            $app->get('', \App\Action\Solicitudes\SolicitudesFinderAction::class);//Completado
            $app->get('/{id_requirement}', \App\Action\Solicitudes\SolicitudesReaderAction::class);//Completado//ESTA TRAE LAS SOLICITUDES DE UN REQUERIMIENTO
            $app->get('/unique/{id_request}', \App\Action\Solicitudes\SolicitudesUniqueReaderAction::class);//Completado//ESTA TRAE LA SOLICITUD UNICA DE UN REQUERIMIENTO
            $app->post('', \App\Action\Solicitudes\SolicitudesCreatorAction::class);//Completado
            $app->put('/{id_request}', \App\Action\Solicitudes\SolicitudesUpdaterAction::class);//Completado
            $app->delete ('/{id_request}', \App\Action\Solicitudes\SolicitudesDeleterAction::class);
        }
    );

    //REQUIREMENTS
    $app->group(
        '/requirements',
        function (RouteCollectorProxy $app) { 
            $app->get('/{nro_pag}/{cant_registros}[/{params:.*}]', \App\Action\Requirements\RequirementsFinderAction::class);//Completado
            $app->get('unique/{id_requirement}', \App\Action\Requirements\RequirementsReaderAction::class);//Completado
            $app->post('', \App\Action\Requirements\RequirementsCreatorAction::class);//Completado
            $app->put('/{id_requirement}', \App\Action\Requirements\RequirementsUpdaterAction::class);
            $app->delete ('/{id_requirement}', \App\Action\Requirements\RequirementsDeleterAction::class);
        }
    );

    //WORKERS
    $app->group(
        '/workers',
        function (RouteCollectorProxy $app) { 
            $app->get('', \App\Action\Workers\WorkersFinderAction::class);//Completado
            $app->get('/{id_worker}', \App\Action\Workers\WorkersReaderAction::class);//Completado
            $app->post('', \App\Action\Workers\WorkersCreatorAction::class);//Completado
            $app->put('/{id_worker}', \App\Action\Workers\WorkersUpdaterAction::class);
            $app->delete ('/{id_worker}', \App\Action\Workers\WorkersDeleterAction::class);
        }
    );
    //CATEGORIES
    $app->group(
        '/categories',
        function (RouteCollectorProxy $app) { 
            $app->get('', \App\Action\Categories\CategoriesFinderAction::class);//Completado
            $app->get('/{id_categories}', \App\Action\Categories\CategoriesReaderAction::class);
            $app->post('', \App\Action\Categories\CategoriesCreatorAction::class);//Completado
            $app->put('/{id_category}', \App\Action\Categories\CategoriesUpdaterAction::class);//Completado
            $app->delete ('/{id_categories}', \App\Action\Categories\CategoriesDeleterAction::class);
        }
    );

    //CARGOS
    $app->group(
        '/charges',
        function (RouteCollectorProxy $app) {            
            $app->get('', \App\Action\Charges\ChargesFinderAction::class);//Completado
            $app->get('/{id_charge}', \App\Action\Charges\ChargesReaderAction::class);//Completado
            $app->post('', \App\Action\Charges\ChargesCreatorAction::class);//Completado
            $app->put('/{id_charge}', \App\Action\Charges\ChargesUpdaterAction::class);
            $app->delete ('/{id_charge}', \App\Action\Charges\ChargesDeleterAction::class);
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
