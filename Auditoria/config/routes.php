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
        '/categorias',
        function (RouteCollectorProxy $app) { 
            $app->get('', \App\Action\Categorias\CategoriasFinderAction::class);
            $app->get('/{id_categorias}', \App\Action\Categorias\CategoriasReaderAction::class);
            $app->post('', \App\Action\Categorias\CategoriasCreatorAction::class);
            $app->put('', \App\Action\Categorias\CategoriasUpdaterAction::class);
            $app->delete ('', \App\Action\Categorias\CategoriasDeleterAction::class);
        }
    );

    //CARGOS
    $app->group(
        '/cargos',
        function (RouteCollectorProxy $app) {            
            $app->get('/cargos', \App\Action\Cargos\CargosFinderAction::class);
            $app->get('/cargos/{cargos_id}', \App\Action\Cargos\CargosReaderAction::class);
            $app->post('/cargos', \App\Action\Cargos\CargosCreatorAction::class);
            $app->put('/cargos', \App\Action\Cargos\CargosUpdaterAction::class);
            $app->delete ('/cargos', \App\Action\Cargos\CargosDeleterAction::class);
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
