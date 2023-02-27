<?php

// Define app routes

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    // Redirect to Swagger documentation
    $app->get('/', \App\Action\Home\HomeAction::class)->setName('home');
    $app->get('/dashboard', \App\Action\Home\HomeAction::class)->setName('dashboard');


    //Appointment
    $app->group(
        '/appointments',
        function (RouteCollectorProxy $app) { 
            $app->get('', \App\Action\Appointment\AppointmentFinderAction::class);//Completado
            $app->get('/{id_appointment}', \App\Action\Appointment\AppointmentReaderAction::class);//Completado
            $app->post('', \App\Action\Appointment\AppointmentCreatorAction::class);//Completado
            $app->put('/{id_appointment}', \App\Action\Appointment\AppointmentUpdaterAction::class);
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
            $app->put('/{id_company}', \App\Action\Companies\CompaniesUpdaterAction::class);
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
            $app->put('/{id_requirement}', \App\Action\Solicitudes\SolicitudesUpdaterAction::class);
            $app->delete ('/{id_requirement}', \App\Action\Solicitudes\SolicitudesDeleterAction::class);
        }
    );

    //REQUIREMENTS
    $app->group(
        '/requirements',
        function (RouteCollectorProxy $app) { 
            $app->get('', \App\Action\Requirements\RequirementsFinderAction::class);//Completado
            $app->get('/{id_requirement}', \App\Action\Requirements\RequirementsReaderAction::class);
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
    //CATEGORIAS
    $app->group(
        '/categories',
        function (RouteCollectorProxy $app) { 
            $app->get('', \App\Action\Categories\CategoriesFinderAction::class);//Completado
            $app->get('/{id_categories}', \App\Action\Categories\CategoriesReaderAction::class);
            $app->post('', \App\Action\Categories\CategoriesCreatorAction::class);//Completado
            $app->put('/{id_categories}', \App\Action\Categories\CategoriesUpdaterAction::class);
            $app->delete ('/{id_categories}', \App\Action\Categories\CategoriesDeleterAction::class);
        }
    );

    //CARGOS
    $app->group(
        '/cargos',
        function (RouteCollectorProxy $app) {            
            $app->get('', \App\Action\Cargos\CargosFinderAction::class);//Completado
            $app->get('/{id}', \App\Action\Cargos\CargosReaderAction::class);//Completado
            $app->post('', \App\Action\Cargos\CargosCreatorAction::class);//Completado
            $app->put('', \App\Action\Cargos\CargosUpdaterAction::class);
            $app->delete ('', \App\Action\Cargos\CargosDeleterAction::class);
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
