<?php

// Define app routes

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    // Redirect to Swagger documentation
    $app->get('/', \App\Action\Home\HomeAction::class)->setName('home');
    $app->get('/dashboard', \App\Action\Home\HomeAction::class)->setName('dashboard');

    $app->group('/categorias', function(RouteCollectorProxy $app){
        //Categorias
        $app->get('', \App\Action\Categorias\CategoriasFinderAction::class);
        $app->get('/categorias/{id_categoria}', \App\Action\Categorias\CategoriasReaderAction::class);
        $app->post('/categorias', \App\Action\Categorias\CategoriasCreatorAction::class);
        $app->put('/categorias', \App\Action\Categorias\CategoriasUpdaterAction::class);
        $app->delete ('/categorias', \App\Action\Categorias\CategoriasDeleterAction::class);
        //Categorias
    });

    // API
    $app->group(
        '/api',
        function (RouteCollectorProxy $app) {
            
            //Cargos
            $app->get('/cargos', \App\Action\Cargos\CargosFinderAction::class);
            $app->get('/cargos/{cargos_id}', \App\Action\Cargos\CargosReaderAction::class);
            $app->post('/cargos', \App\Action\Cargos\CargosCreatorAction::class);
            $app->put('/cargos', \App\Action\Cargos\CargosUpdaterAction::class);
            $app->delete ('/cargos', \App\Action\Cargos\CargosDeleterAction::class);
            //Cargos

            //customer
            $app->get('/customers', \App\Action\Customer\CustomerFinderAction::class);
            $app->get('/customers/{customer_id}', \App\Action\Customer\CustomerReaderAction::class);
            $app->post('/customers', \App\Action\Customer\CustomerCreatorAction::class);
            $app->put('/customers/{customer_id}', \App\Action\Customer\CustomerUpdaterAction::class);
            $app->delete('/customers/{customer_id}', \App\Action\Customer\CustomerDeleterAction::class);
            //customer

        }
    );
};
