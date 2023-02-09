<?php

// Define app routes

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    // Redirect to Swagger documentation
    $app->get('/', \App\Action\Home\HomeAction::class)->setName('home');
    $app->get('/dashboard', \App\Action\Home\HomeAction::class)->setName('dashboard');

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
           
            $app->get('/customers', \App\Action\Customer\CustomerFinderAction::class);
            $app->get('/customers/{customer_id}', \App\Action\Customer\CustomerReaderAction::class);
            $app->post('/customers', \App\Action\Customer\CustomerCreatorAction::class);
            $app->put('/customers/{customer_id}', \App\Action\Customer\CustomerUpdaterAction::class);
            $app->delete('/customers/{customer_id}', \App\Action\Customer\CustomerDeleterAction::class);
        }
    );
};
